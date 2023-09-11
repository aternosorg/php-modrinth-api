<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\ProjectDependencies;
use Aternos\ModrinthApi\Client\Version;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ProjectDependenciesTest extends TestCase
{

    public function testGetUserReturnsCorrectUser(): void
    {
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/get_project_dependencies_response.json"))
        ]);
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => HandlerStack::create($handler)]));

        // YL57xq9U -> https://modrinth.com/mod/iris
        $dependencies = $client->getProjectDependencies("YL57xq9U");

        $firstProject = $dependencies->getProjects()[0];
        $this->assertEquals("AANobbMI", $firstProject->getData()->getId());
        $this->assertEquals("sodium", $firstProject->getData()->getSlug());

        $firstVersion = $dependencies->getVersions()[0];
        $this->assertEquals("vgceLbdH", $firstVersion->getData()->getId());
        $this->assertEquals("Sodium 0.4.10", $firstVersion->getData()->getName());
    }

    public function testGetDataReturnsCorrectProjectModel(): void
    {
        $client = new ModrinthAPIClient();
        $projectDependencyList = $this->getExampleProjectDependencyListModel();
        $projectDependencies = new ProjectDependencies($client, $projectDependencyList);

        $projects = [];
        foreach ($projectDependencyList->getProjects() as $project) {
            $projects[] = new Project($client, $project);
        }

        $versions = [];
        foreach ($projectDependencyList->getVersions() as $version) {
            $versions[] = new Version($client, $version);
        }

        $this->assertEquals($projects, $projectDependencies->getProjects());
        $this->assertEquals($versions, $projectDependencies->getVersions());
    }

    protected function getExampleProjectDependencyListModel(): \Aternos\ModrinthApi\Model\ProjectDependencyList
    {
        $json = json_decode(file_get_contents(__DIR__ . "/../Fixtures/get_project_dependencies_response.json"), true);
        $projects = array_map(fn($element) => new \Aternos\ModrinthApi\Model\Project($element), $json["projects"]);
        $versions = array_map(fn($element) => new \Aternos\ModrinthApi\Model\Version($element), $json["versions"]);
        return (new \Aternos\ModrinthApi\Model\ProjectDependencyList())
            ->setProjects($projects)
            ->setVersions($versions);
    }
}