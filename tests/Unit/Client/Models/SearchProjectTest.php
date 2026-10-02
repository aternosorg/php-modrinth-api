<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\SearchProject;
use Aternos\ModrinthApi\Model\ProjectResult;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class SearchProjectTest extends TestCase
{
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

    public function testGetFullProjectRequestsTheProjectId(): void
    {
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/get_project_response.json"))
        ]);
        $requests = [];
        $stack = HandlerStack::create($handler);
        $stack->push(Middleware::history($requests));
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => $stack]));

        $searchProject = new SearchProject($client, $this->getExampleProjectResultModel());
        $searchProject->getFullProject();

        $this->assertCount(1, $requests);
        $this->assertEquals("/v2/project/P7dR8mSH", $requests[0]["request"]->getUri()->getPath());
    }

    public function testGetDependenciesUsesTheProjectId(): void
    {
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/get_project_dependencies_response.json"))
        ]);
        $requests = [];
        $stack = HandlerStack::create($handler);
        $stack->push(Middleware::history($requests));
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => $stack]));

        $searchProject = new SearchProject($client, $this->getExampleProjectResultModel());
        $this->assertNotEmpty($searchProject->getDependencies()->getProjects());

        $this->assertEquals("/v2/project/P7dR8mSH/dependencies", $requests[0]["request"]->getUri()->getPath());
    }

    protected function getExampleProjectResultModel(): ProjectResult
    {
        $json = json_decode(file_get_contents(__DIR__ . "/../Fixtures/search_projects_response.json"), true);
        $modelJson = $json["hits"][0];
        return new ProjectResult($modelJson);
    }
}
