<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Threads;

use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\Threads\Report;
use Aternos\ModrinthApi\Client\Threads\ReportItemType;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Model\Report as ReportModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;
use Exception;
use GuzzleHttp\Psr7\Response;

class ReportTest extends ClientTestCase
{
    /**
     * @param string $itemType
     * @param string $itemId
     * @return ReportModel
     */
    protected function getExampleReportModel(string $itemType = "project", string $itemId = "VPo0otUH"): ReportModel
    {
        return new ReportModel(array_merge(
            $this->fixtureData("get_report_response"),
            ["item_type" => $itemType, "item_id" => $itemId],
        ));
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $model = $this->getExampleReportModel();
        $report = new Report($this->createClient(), $model);

        $this->assertEquals($model->getId(), $report->getId());
        $this->assertEquals($model->getReportType(), $report->getReportType());
        $this->assertEquals($model->getThreadId(), $report->getThreadId());
    }

    public function testGetItemTypeEnum(): void
    {
        $client = $this->createClient();

        $this->assertEquals(
            ReportItemType::PROJECT,
            (new Report($client, $this->getExampleReportModel("project")))->getItemTypeEnum()
        );
        $this->assertEquals(
            ReportItemType::USER,
            (new Report($client, $this->getExampleReportModel("user")))->getItemTypeEnum()
        );
        $this->assertEquals(
            ReportItemType::VERSION,
            (new Report($client, $this->getExampleReportModel("version")))->getItemTypeEnum()
        );
    }

    public function testGetProject(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_project_response")]);
        $report = new Report($client, $this->getExampleReportModel("project", "mOgUt4GM"));

        $this->assertInstanceOf(Project::class, $report->getProject());
        $this->assertRequest("GET", "/v2/project/mOgUt4GM");
    }

    public function testGetProjectThrowsForOtherReportTypes(): void
    {
        $report = new Report($this->createClient(), $this->getExampleReportModel("user"));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Report is not a project report");
        $report->getProject();
    }

    public function testGetUser(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_user_response")]);
        $report = new Report($client, $this->getExampleReportModel("user", "Dc7EYhxG"));

        $this->assertInstanceOf(User::class, $report->getUser());
        $this->assertRequest("GET", "/v2/user/Dc7EYhxG");
    }

    public function testGetUserThrowsForOtherReportTypes(): void
    {
        $report = new Report($this->createClient(), $this->getExampleReportModel("project"));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Report is not a user report");
        $report->getUser();
    }

    public function testGetVersion(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_version_response")]);
        $report = new Report($client, $this->getExampleReportModel("version", "moYTqMH3"));

        $this->assertInstanceOf(Version::class, $report->getVersion());
        $this->assertRequest("GET", "/v2/version/moYTqMH3");
    }

    public function testGetVersionThrowsForOtherReportTypes(): void
    {
        $report = new Report($this->createClient(), $this->getExampleReportModel("project"));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Report is not a version report");
        $report->getVersion();
    }

    public function testModify(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);
        $report = new Report($client, $this->getExampleReportModel());

        $this->assertSame($report, $report->modify("Updated body", true));
        $this->assertRequest("PATCH", "/v2/report/RepOrt01");
        $this->assertRequestAuthenticated();
        $this->assertEquals(
            ["body" => "Updated body", "closed" => true],
            json_decode((string)$this->getRequest()->getBody(), true)
        );
    }

    public function testReportItemTypeCases(): void
    {
        $this->assertEquals("project", ReportItemType::PROJECT->value);
        $this->assertEquals("user", ReportItemType::USER->value);
        $this->assertEquals("version", ReportItemType::VERSION->value);
    }
}
