<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Notification;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\Threads\Report;
use Aternos\ModrinthApi\Client\Threads\ReportItemType;
use Aternos\ModrinthApi\Client\Threads\Thread;
use Aternos\ModrinthApi\Client\Threads\ThreadMessageType;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\Model\UserPayoutHistory;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Tests for the parts of ModrinthAPIClient that cannot be covered by integration tests:
 * client configuration and every endpoint that requires authentication.
 */
class ModrinthAPIClientTest extends ClientTestCase
{
    public function testConstructorUsesDefaultConfiguration(): void
    {
        $client = new ModrinthAPIClient();

        $this->assertInstanceOf(ModrinthAPIClient::class, $client);
        $this->assertStringStartsWith("php-modrinth-api/", Configuration::getDefaultConfiguration()->getUserAgent());
    }

    /**
     * Configuration::getDefaultConfiguration() is a process wide singleton, so clients
     * created without an explicit configuration share one. Changing the token or user
     * agent of one of them therefore also changes it for the others.
     */
    public function testClientsWithoutExplicitConfigurationShareOne(): void
    {
        $first = new ModrinthAPIClient();
        $second = new ModrinthAPIClient();

        $first->setUserAgent("first-agent/1.0");
        $this->assertEquals("first-agent/1.0", Configuration::getDefaultConfiguration()->getUserAgent());

        $second->setUserAgent("second-agent/1.0");
        $this->assertEquals("second-agent/1.0", Configuration::getDefaultConfiguration()->getUserAgent());

        // reset the shared configuration so that it cannot affect other tests
        Configuration::getDefaultConfiguration()
            ->setUserAgent("php-modrinth-api/2.0.0")
            ->setApiKey("Authorization", null);
    }

    public function testExplicitConfigurationIsNotShared(): void
    {
        $configuration = new Configuration();
        $client = new ModrinthAPIClient(null, $configuration);

        $client->setUserAgent("isolated-agent/1.0");

        $this->assertEquals("isolated-agent/1.0", $configuration->getUserAgent());
        $this->assertNotEquals("isolated-agent/1.0", Configuration::getDefaultConfiguration()->getUserAgent());
    }

    public function testSetConfigurationForcesStringBooleans(): void
    {
        $configuration = new Configuration();
        $client = new ModrinthAPIClient(null, $configuration);

        $this->assertSame($client, $client->setConfiguration($configuration));
        $this->assertEquals(
            Configuration::BOOLEAN_FORMAT_STRING,
            $configuration->getBooleanFormatForQueryString()
        );

        // ObjectSerializer reads this from the default configuration, not from the
        // configuration of the client, so it has to be set there too
        $this->assertEquals(
            Configuration::BOOLEAN_FORMAT_STRING,
            Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()
        );
    }

    public function testBooleanQueryParametersUseStringsWithACustomConfiguration(): void
    {
        Configuration::getDefaultConfiguration()
            ->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_INT);

        $client = $this->createClient([$this->jsonResponse([])]);
        $client->getProjectVersions("mclogs", null, null, true, false);

        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals("true", $query["featured"]);
        $this->assertEquals("false", $query["include_changelog"]);
    }

    public function testSetUserAgentIsSentWithRequests(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_project_response")]);
        $this->assertSame($client, $client->setUserAgent("test-agent/1.0"));

        $client->getProject("modmenu");
        $this->assertEquals("test-agent/1.0", $this->getRequest()->getHeaderLine("User-Agent"));
    }

    public function testSetApiTokenIsSentWithRequests(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_user_response")]);
        $this->assertSame($client, $client->setApiToken(static::API_TOKEN));

        $client->getCurrentUser();
        $this->assertRequestAuthenticated();
    }

    public function testSetApiTokenToNullRemovesAuthentication(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_project_response")]);
        $this->assertSame($client, $client->setApiToken(null));

        $client->getProject("modmenu");
        $this->assertFalse($this->getRequest()->hasHeader("Authorization"));
    }

    public function testSetHttpClientReplacesTheHttpClient(): void
    {
        $client = new ModrinthAPIClient(null, new Configuration());
        $handler = new MockHandler([$this->fixtureResponse("get_project_response")]);
        $stack = HandlerStack::create($handler);

        $this->assertSame($client, $client->setHttpClient(new Client(["handler" => $stack])));
        $this->assertEquals("modmenu", $client->getProject("modmenu")->getSlug());
    }

    public function testCheckProjectValidityRethrowsNonNotFoundErrors(): void
    {
        $client = $this->createClient([new Response(500, [], "Internal Server Error")]);

        $this->expectException(ApiException::class);
        $client->checkProjectValidity("mclogs");
    }

    /**
     * Every endpoint that checks for an API token before sending a request
     * @return array<string, array{0: string, 1: array}>
     */
    public static function authenticationRequiredMethodProvider(): array
    {
        return [
            "getCurrentUser" => ["getCurrentUser", []],
            "getFollowedProjects" => ["getFollowedProjects", ["b1AIbOxO"]],
            "getPayoutHistory" => ["getPayoutHistory", ["b1AIbOxO"]],
            "getUserNotifications" => ["getUserNotifications", ["b1AIbOxO"]],
        ];
    }

    #[DataProvider("authenticationRequiredMethodProvider")]
    public function testMethodThrowsWithoutApiToken(string $method, array $arguments): void
    {
        $client = $this->createClient();

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage("No API token set");
        $client->$method(...$arguments);
    }

    #[DataProvider("authenticationRequiredMethodProvider")]
    public function testMethodSendsNoRequestWithoutApiToken(string $method, array $arguments): void
    {
        $client = $this->createClient();

        try {
            $client->$method(...$arguments);
        } catch (ApiException) {
            // expected, asserted in testMethodThrowsWithoutApiToken
        }

        $this->assertRequestCount(0);
    }

    public function testGetCurrentUser(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_user_response")]);

        $user = $client->getCurrentUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals("Dc7EYhxG", $user->getId());
        $this->assertRequest("GET", "/v2/user");
        $this->assertRequestAuthenticated();
    }

    public function testGetFollowedProjects(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_project_response")]),
        ]);

        $projects = $client->getFollowedProjects("b1AIbOxO");
        $this->assertCount(1, $projects);
        $this->assertInstanceOf(Project::class, $projects[0]);
        $this->assertEquals("modmenu", $projects[0]->getSlug());
        $this->assertRequest("GET", "/v2/user/b1AIbOxO/follows");
        $this->assertRequestAuthenticated();
    }

    public function testGetPayoutHistory(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_payout_history_response")]);

        $history = $client->getPayoutHistory("b1AIbOxO");
        $this->assertInstanceOf(UserPayoutHistory::class, $history);
        $this->assertEquals("1234.56", $history->getAllTime());
        $this->assertCount(1, $history->getPayouts());
        $this->assertRequest("GET", "/v2/user/b1AIbOxO/payouts");
        $this->assertRequestAuthenticated();
    }

    public function testGetNotification(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_notification_response")]);

        $notification = $client->getNotification("UUVVWWXX");
        $this->assertInstanceOf(Notification::class, $notification);
        $this->assertEquals("UUVVWWXX", $notification->getId());
        $this->assertRequest("GET", "/v2/notification/UUVVWWXX");
        $this->assertRequestAuthenticated();
    }

    public function testGetNotifications(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_notification_response")]),
        ]);

        $notifications = $client->getNotifications(["UUVVWWXX"]);
        $this->assertCount(1, $notifications);
        $this->assertInstanceOf(Notification::class, $notifications[0]);
        $this->assertRequest("GET", "/v2/notifications");
        $this->assertEquals('ids=%5B%22UUVVWWXX%22%5D', $this->getRequest()->getUri()->getQuery());
    }

    public function testGetUserNotifications(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_notification_response")]),
        ]);

        $notifications = $client->getUserNotifications("b1AIbOxO");
        $this->assertCount(1, $notifications);
        $this->assertInstanceOf(Notification::class, $notifications[0]);
        $this->assertRequest("GET", "/v2/user/b1AIbOxO/notifications");
        $this->assertRequestAuthenticated();
    }

    public function testDeleteNotification(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->deleteNotification("UUVVWWXX");
        $this->assertRequest("DELETE", "/v2/notification/UUVVWWXX");
        $this->assertRequestAuthenticated();
    }

    public function testDeleteNotifications(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->deleteNotifications(["UUVVWWXX", "YYZZAABB"]);
        $this->assertRequest("DELETE", "/v2/notifications");
        $this->assertEquals('ids=%5B%22UUVVWWXX%22%2C%22YYZZAABB%22%5D', $this->getRequest()->getUri()->getQuery());
    }

    public function testReadNotification(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->readNotification("UUVVWWXX");
        $this->assertRequest("PATCH", "/v2/notification/UUVVWWXX");
        $this->assertRequestAuthenticated();
    }

    public function testReadNotifications(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->readNotifications(["UUVVWWXX", "YYZZAABB"]);
        $this->assertRequest("PATCH", "/v2/notifications");
        $this->assertEquals('ids=%5B%22UUVVWWXX%22%2C%22YYZZAABB%22%5D', $this->getRequest()->getUri()->getQuery());
    }

    public function testSubmitReport(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_report_response")]);

        $report = $client->submitReport("spam", "VPo0otUH", ReportItemType::PROJECT, "This project is spam.");
        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals("RepOrt01", $report->getId());
        $this->assertRequest("POST", "/v2/report");
        $this->assertRequestAuthenticated();

        $this->assertEquals([
            "report_type" => "spam",
            "item_id" => "VPo0otUH",
            "item_type" => "project",
            "body" => "This project is spam.",
        ], json_decode((string)$this->getRequest()->getBody(), true));
    }

    public function testGetOpenReports(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_report_response")]),
        ]);

        $reports = $client->getOpenReports();
        $this->assertCount(1, $reports);
        $this->assertInstanceOf(Report::class, $reports[0]);
        $this->assertRequest("GET", "/v2/report");
        $this->assertRequestAuthenticated();
    }

    public function testGetReport(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_report_response")]);

        $report = $client->getReport("RepOrt01");
        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals("RepOrt01", $report->getId());
        $this->assertRequest("GET", "/v2/report/RepOrt01");
        $this->assertRequestAuthenticated();
    }

    public function testGetReports(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_report_response")]),
        ]);

        $reports = $client->getReports(["RepOrt01"]);
        $this->assertCount(1, $reports);
        $this->assertInstanceOf(Report::class, $reports[0]);
        $this->assertRequest("GET", "/v2/reports");
    }

    public function testModifyReport(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->modifyReport("RepOrt01", "Updated body", true);
        $this->assertRequest("PATCH", "/v2/report/RepOrt01");
        $this->assertRequestAuthenticated();
        $this->assertEquals(
            ["body" => "Updated body", "closed" => true],
            json_decode((string)$this->getRequest()->getBody(), true)
        );
    }

    public function testGetThread(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);

        $thread = $client->getThread("Ba1AaBbC");
        $this->assertInstanceOf(Thread::class, $thread);
        $this->assertEquals("Ba1AaBbC", $thread->getId());
        $this->assertRequest("GET", "/v2/thread/Ba1AaBbC");
        $this->assertRequestAuthenticated();
    }

    public function testGetThreads(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_thread_response")]),
        ]);

        $threads = $client->getThreads(["Ba1AaBbC"]);
        $this->assertCount(1, $threads);
        $this->assertInstanceOf(Thread::class, $threads[0]);
        $this->assertRequest("GET", "/v2/threads");
    }

    public function testSendThreadMessage(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);

        $thread = $client->sendThreadMessage(
            "Ba1AaBbC",
            ThreadMessageType::TEXT,
            "Hello there",
            true,
            "MsG00001",
            "processing",
            "approved",
        );

        $this->assertInstanceOf(Thread::class, $thread);
        $this->assertRequest("POST", "/v2/thread/Ba1AaBbC");
        $this->assertRequestAuthenticated();
        $this->assertEquals([
            "type" => "text",
            "body" => "Hello there",
            "private" => true,
            "replying_to" => "MsG00001",
            "old_status" => "processing",
            "new_status" => "approved",
        ], json_decode((string)$this->getRequest()->getBody(), true));
    }

    public function testSendThreadMessageOmitsOptionsThatWereNotPassed(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);

        $client->sendThreadMessage("Ba1AaBbC", ThreadMessageType::TEXT, "Hello there");

        $this->assertEquals(
            ["type" => "text", "body" => "Hello there"],
            json_decode((string)$this->getRequest()->getBody(), true)
        );
    }

    public function testSendThreadMessageWithoutAnyOptions(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);

        $client->sendThreadMessage("Ba1AaBbC", ThreadMessageType::THREAD_CLOSURE);

        $this->assertEquals(
            ["type" => "thread_closure"],
            json_decode((string)$this->getRequest()->getBody(), true)
        );
    }

    public function testModifyReportOmitsOptionsThatWereNotPassed(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204), new Response(204)]);

        $client->modifyReport("RepOrt01", "Only the body", null);
        $this->assertEquals(
            ["body" => "Only the body"],
            json_decode((string)$this->getRequest(0)->getBody(), true)
        );

        $client->modifyReport("RepOrt01", null, true);
        $this->assertEquals(
            ["closed" => true],
            json_decode((string)$this->getRequest(1)->getBody(), true)
        );
    }

    public function testModifyReportWithoutAnyOptions(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->modifyReport("RepOrt01", null, null);
        $this->assertEquals([], json_decode((string)$this->getRequest()->getBody(), true));
    }

    public function testDeleteThreadMessage(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);

        $client->deleteThreadMessage("Ba1AaBbC", "MsG00001");
        $this->assertRequest("DELETE", "/v2/message/MsG00001");
        $this->assertRequestAuthenticated();

        // the message id, not the thread id, identifies the message that is deleted
        $this->assertStringNotContainsString("Ba1AaBbC", (string)$this->getRequest()->getUri());
        $this->assertStringContainsString("application/json", $this->getRequest()->getHeaderLine("Content-Type"));
    }
}
