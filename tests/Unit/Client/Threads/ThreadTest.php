<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Threads;

use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\Threads\Report;
use Aternos\ModrinthApi\Client\Threads\Thread;
use Aternos\ModrinthApi\Client\Threads\ThreadMessage;
use Aternos\ModrinthApi\Client\Threads\ThreadMessageType;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Model\Thread as ThreadModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;
use GuzzleHttp\Psr7\Response;

class ThreadTest extends ClientTestCase
{
    protected function getExampleThreadModel(string $fixture = "get_thread_response"): ThreadModel
    {
        return $this->fixtureModel($fixture, ThreadModel::class);
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $model = $this->getExampleThreadModel();
        $thread = new Thread($this->createClient(), $model);

        $this->assertEquals($model->getId(), $thread->getId());
        $this->assertEquals($model->getType(), $thread->getType());
        $this->assertEquals($model->getProjectId(), $thread->getProjectId());
    }

    public function testGetProject(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_project_response")]);
        $thread = new Thread($client, $this->getExampleThreadModel());

        $this->assertInstanceOf(Project::class, $thread->getProject());
        $this->assertRequest("GET", "/v2/project/VPo0otUH");
    }

    public function testGetProjectReturnsNullWithoutProjectId(): void
    {
        $client = $this->createAuthenticatedClient();
        $thread = new Thread($client, $this->getExampleThreadModel("get_thread_without_references_response"));

        $this->assertNull($thread->getProject());
        $this->assertRequestCount(0);
    }

    public function testGetReport(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_report_response")]);
        $thread = new Thread($client, $this->getExampleThreadModel());

        $report = $thread->getReport();
        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals("RepOrt01", $report->getId());
        $this->assertRequest("GET", "/v2/report/RepOrt01");
    }

    public function testGetReportReturnsNullWithoutReportId(): void
    {
        $client = $this->createAuthenticatedClient();
        $thread = new Thread($client, $this->getExampleThreadModel("get_thread_without_references_response"));

        $this->assertNull($thread->getReport());
        $this->assertRequestCount(0);
    }

    public function testGetMessages(): void
    {
        $thread = new Thread($this->createClient(), $this->getExampleThreadModel());

        $messages = $thread->getMessages();
        $this->assertCount(2, $messages);
        foreach ($messages as $message) {
            $this->assertInstanceOf(ThreadMessage::class, $message);
            $this->assertSame($thread, $message->getThread());
        }
        $this->assertEquals("MsG00001", $messages[0]->getId());
        $this->assertRequestCount(0);
    }

    public function testGetMessagesOnEmptyThread(): void
    {
        $thread = new Thread(
            $this->createClient(),
            $this->getExampleThreadModel("get_thread_without_references_response")
        );

        $this->assertSame([], $thread->getMessages());
    }

    public function testGetMembers(): void
    {
        $thread = new Thread($this->createClient(), $this->getExampleThreadModel());

        $members = $thread->getMembers();
        $this->assertCount(2, $members);
        foreach ($members as $member) {
            $this->assertInstanceOf(User::class, $member);
        }
        $this->assertEquals("Julian", $members[0]->getUsername());
        $this->assertRequestCount(0);
    }

    public function testGetMembersOnEmptyThread(): void
    {
        $thread = new Thread(
            $this->createClient(),
            $this->getExampleThreadModel("get_thread_without_references_response")
        );

        $this->assertSame([], $thread->getMembers());
    }

    public function testSendMessage(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);
        $thread = new Thread($client, $this->getExampleThreadModel());

        $updated = $thread->sendMessage(
            ThreadMessageType::TEXT,
            "Hello there",
            false,
            "MsG00001",
            "processing",
            "approved",
        );

        $this->assertInstanceOf(Thread::class, $updated);
        $this->assertRequest("POST", "/v2/thread/Ba1AaBbC");
        $this->assertRequestAuthenticated();
        $this->assertEquals([
            "type" => "text",
            "body" => "Hello there",
            "private" => false,
            "replying_to" => "MsG00001",
            "old_status" => "processing",
            "new_status" => "approved",
        ], json_decode((string)$this->getRequest()->getBody(), true));
    }

    public function testDeleteMessage(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);
        $thread = new Thread($client, $this->getExampleThreadModel());

        $thread->deleteMessage("MsG00002");
        $this->assertRequest("DELETE", "/v2/message/MsG00002");
        $this->assertRequestAuthenticated();
    }

    public function testThreadMessageTypeCases(): void
    {
        $this->assertEquals("status_change", ThreadMessageType::STATUS_CHANGE->value);
        $this->assertEquals("text", ThreadMessageType::TEXT->value);
        $this->assertEquals("thread_closure", ThreadMessageType::THREAD_CLOSURE->value);
        $this->assertEquals("deleted", ThreadMessageType::DELETED->value);
    }
}
