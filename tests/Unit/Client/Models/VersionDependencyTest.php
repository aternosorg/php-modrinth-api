<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Client\VersionDependency;
use Aternos\ModrinthApi\Model\Version as VersionModel;
use Aternos\ModrinthApi\Model\VersionDependency as VersionDependencyModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;

class VersionDependencyTest extends ClientTestCase
{
    /**
     * @param int $index index of the dependency in the version fixture
     * @return VersionDependencyModel
     */
    protected function getExampleDependencyModel(int $index = 0): VersionDependencyModel
    {
        return $this->fixtureModel("get_version_response", VersionModel::class)->getDependencies()[$index];
    }

    public function testFetchProject(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_project_response")]);
        $dependency = new VersionDependency($client, $this->getExampleDependencyModel());

        $project = $dependency->fetchProject();
        $this->assertInstanceOf(Project::class, $project);
        $this->assertRequest("GET", "/v2/project/AANobbMI");
    }

    public function testFetchProjectReturnsNullWithoutProjectId(): void
    {
        $client = $this->createClient();
        $dependency = new VersionDependency($client, $this->getExampleDependencyModel(1));

        $this->assertNull($dependency->fetchProject());
        $this->assertRequestCount(0);
    }

    public function testFetchVersion(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_version_response")]);
        $dependency = new VersionDependency($client, $this->getExampleDependencyModel());

        $version = $dependency->fetchVersion();
        $this->assertInstanceOf(Version::class, $version);
        $this->assertRequest("GET", "/v2/version/vgceLbdH");
    }

    public function testFetchVersionReturnsNullWithoutVersionId(): void
    {
        $client = $this->createClient();
        $dependency = new VersionDependency($client, $this->getExampleDependencyModel(1));

        $this->assertNull($dependency->fetchVersion());
        $this->assertRequestCount(0);
    }
}
