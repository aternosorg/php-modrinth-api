<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\SearchProject;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Model\ProjectResult;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class SearchProjectTest extends TestCase
{
    public function testFetchFullProjectReturnsInstanceOfProject(): void
    {
        $projectResultModel = $this->getExampleProjectResultModel();
        // Here we must mock the client, because it requests the user from the API to get all details
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/getProject.json"))
        ]);
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => HandlerStack::create($handler)]));

        $searchProject = new SearchProject($client, $projectResultModel);
        $this->assertInstanceOf(Project::class, $searchProject->fetchFullProject());
    }

    public function testFetchFullProjectRequestsTheProjectId(): void
    {
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/getProject.json"))
        ]);
        $requests = [];
        $stack = HandlerStack::create($handler);
        $stack->push(Middleware::history($requests));
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => $stack]));

        $searchProject = new SearchProject($client, $this->getExampleProjectResultModel());
        $searchProject->fetchFullProject();

        $this->assertCount(1, $requests);
        $this->assertEquals("/v2/project/P7dR8mSH", $requests[0]["request"]->getUri()->getPath());
    }

    public function testFetchDependenciesUsesTheProjectId(): void
    {
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/getDependencies.json"))
        ]);
        $requests = [];
        $stack = HandlerStack::create($handler);
        $stack->push(Middleware::history($requests));
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => $stack]));

        $searchProject = new SearchProject($client, $this->getExampleProjectResultModel());
        $this->assertNotEmpty($searchProject->fetchDependencies()->getProjects());

        $this->assertEquals("/v2/project/P7dR8mSH/dependencies", $requests[0]["request"]->getUri()->getPath());
    }

    public function testFetchAuthor(): void
    {
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/getUser.json"))
        ]);
        $requests = [];
        $stack = HandlerStack::create($handler);
        $stack->push(Middleware::history($requests));
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => $stack]));

        $model = $this->getExampleProjectResultModel();
        $model->setAuthorId("Dc7EYhxG");

        $author = (new SearchProject($client, $model))->fetchAuthor();
        $this->assertInstanceOf(User::class, $author);
        $this->assertEquals("Prospector", $author->getUsername());
        $this->assertEquals("/v2/user/Dc7EYhxG", $requests[0]["request"]->getUri()->getPath());
    }

    public function testFetchAuthorReturnsNullWithoutAuthorId(): void
    {
        $client = new ModrinthAPIClient(null, null, new Client([
            'handler' => HandlerStack::create(new MockHandler([]))
        ]));

        $model = $this->getExampleProjectResultModel();
        $model->setAuthorId(null);

        $this->assertNull((new SearchProject($client, $model))->fetchAuthor());
    }

    public function testGetAuthorStillReturnsTheUsername(): void
    {
        $client = new ModrinthAPIClient(null, null, new Client([
            'handler' => HandlerStack::create(new MockHandler([]))
        ]));

        $searchProject = new SearchProject($client, $this->getExampleProjectResultModel());
        $this->assertEquals("modmuss50", $searchProject->getAuthor());
    }

    protected function getExampleProjectResultModel(): ProjectResult
    {
        $json = json_decode(file_get_contents(__DIR__ . "/../Fixtures/searchProjects.json"), true);
        $modelJson = $json["hits"][0];
        return new ProjectResult($modelJson);
    }
}
