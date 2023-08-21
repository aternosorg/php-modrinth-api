<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\SearchProject;
use Aternos\ModrinthApi\Model\ProjectResult;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class SearchProjectTest extends TestCase
{

    public function testGetDataReturnsCorrectProjectModel(): void
    {
        $projectResultModel = $this->getExampleProjectResultModel();
        $searchProject = new SearchProject(new ModrinthAPIClient(), $projectResultModel);
        $this->assertEquals($projectResultModel, $searchProject->getData());
    }

    public function testGetFullProjectReturnsInstanceOfProject(): void
    {
        $projectResultModel = $this->getExampleProjectResultModel();
        // Here we must mock the client, because it requests the user from the API to get all details
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/get_project_response.json"))
        ]);
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => HandlerStack::create($handler)]));

        $searchProject = new SearchProject($client, $projectResultModel);
        $this->assertInstanceOf(Project::class, $searchProject->getFullProject());
    }

    protected function getExampleProjectResultModel(): ProjectResult
    {
        $json = json_decode(file_get_contents(__DIR__ . "/../Fixtures/search_projects_response.json"), true);
        $modelJson = $json["hits"][0];
        return new ProjectResult($modelJson);
    }
}