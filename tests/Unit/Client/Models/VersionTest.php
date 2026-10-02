<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Client\VersionDependency;
use Aternos\ModrinthApi\Model\Version as VersionModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;

class VersionTest extends ClientTestCase
{
    protected function getExampleVersionModel(string $fixture = "get_version_response"): VersionModel
    {
        return $this->fixtureModel($fixture, VersionModel::class);
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $model = $this->getExampleVersionModel();
        $version = new Version($this->createClient(), $model);

        $this->assertEquals($model->getId(), $version->getId());
        $this->assertEquals($model->getVersionNumber(), $version->getVersionNumber());
    }

    public function testGetProject(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_project_response")]);
        $version = new Version($client, $this->getExampleVersionModel());

        $project = $version->getProject();
        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals("modmenu", $project->getSlug());
        $this->assertRequest("GET", "/v2/project/VPo0otUH");
    }

    public function testGetAuthor(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_user_response")]);
        $version = new Version($client, $this->getExampleVersionModel());

        $author = $version->getAuthor();
        $this->assertInstanceOf(User::class, $author);
        $this->assertEquals("Prospector", $author->getUsername());
        $this->assertRequest("GET", "/v2/user/b1AIbOxO");
    }

    public function testGetDependenciesWrapsEveryDependency(): void
    {
        $version = new Version($this->createClient(), $this->getExampleVersionModel());

        $dependencies = $version->getDependencies();
        $this->assertCount(2, $dependencies);
        foreach ($dependencies as $dependency) {
            $this->assertInstanceOf(VersionDependency::class, $dependency);
        }

        $this->assertEquals("vgceLbdH", $dependencies[0]->getVersionId());
        $this->assertEquals("AANobbMI", $dependencies[0]->getProjectId());
        $this->assertEquals("required", $dependencies[0]->getDependencyType());
        $this->assertRequestCount(0);
    }

    public function testGetDependenciesReturnsEmptyArrayWhenNull(): void
    {
        $version = new Version(
            $this->createClient(),
            $this->getExampleVersionModel("get_version_without_dependencies_response")
        );

        $this->assertSame([], $version->getDependencies());
        $this->assertRequestCount(0);
    }
}
