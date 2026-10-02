<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\ProjectDependencies;
use Aternos\ModrinthApi\Client\TeamMember;
use Aternos\ModrinthApi\Client\Threads\Thread;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Model\Project as ProjectModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;

/**
 * Tests for Project and the ProjectTrait methods it uses
 */
class ProjectTest extends ClientTestCase
{
    protected function getExampleProjectModel(): ProjectModel
    {
        return $this->fixtureModel("get_project_response", ProjectModel::class);
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $client = $this->createClient();
        $model = $this->getExampleProjectModel();

        $project = new Project($client, $model);
        $this->assertEquals($model->getId(), $project->getId());
        $this->assertEquals($model->getSlug(), $project->getSlug());
        $this->assertEquals($model->getTitle(), $project->getTitle());
    }

    public function testGetDependencies(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_project_dependencies_response")]);
        $project = new Project($client, $this->getExampleProjectModel());

        $dependencies = $project->getDependencies();
        $this->assertInstanceOf(ProjectDependencies::class, $dependencies);
        $this->assertNotEmpty($dependencies->getProjects());
        $this->assertNotEmpty($dependencies->getVersions());
        $this->assertRequest("GET", "/v2/project/mOgUt4GM/dependencies");
    }

    public function testFetchProjectVersions(): void
    {
        $client = $this->createClient([
            $this->jsonResponse([$this->fixtureData("get_version_response")]),
        ]);
        $project = new Project($client, $this->getExampleProjectModel());

        $versions = $project->fetchProjectVersions();
        $this->assertCount(1, $versions);
        $this->assertInstanceOf(Version::class, $versions[0]);
        $this->assertEquals("moYTqMH3", $versions[0]->getId());
        $this->assertRequest("GET", "/v2/project/mOgUt4GM/version");
        $this->assertEquals("", $this->getRequest()->getUri()->getQuery());
    }

    public function testFetchProjectVersionsPassesFilters(): void
    {
        $client = $this->createClient([
            $this->jsonResponse([$this->fixtureData("get_version_response")]),
        ]);
        $project = new Project($client, $this->getExampleProjectModel());

        $project->fetchProjectVersions(["fabric"], ["1.20.1"], true, false);

        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals('["fabric"]', $query["loaders"]);
        $this->assertEquals('["1.20.1"]', $query["game_versions"]);
        $this->assertEquals("true", $query["featured"]);
        $this->assertEquals("false", $query["include_changelog"]);
    }

    public function testGetThread(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);
        $project = new Project($client, $this->getExampleProjectModel());

        $thread = $project->getThread();
        $this->assertInstanceOf(Thread::class, $thread);
        $this->assertEquals("Ba1AaBbC", $thread->getId());
        $this->assertRequest("GET", "/v2/thread/" . $this->getExampleProjectModel()->getThreadId());
        $this->assertRequestAuthenticated();
    }

    public function testGetMembers(): void
    {
        $client = $this->createClient([$this->fixtureResponse("get_team_members_response")]);
        $project = new Project($client, $this->getExampleProjectModel());

        $members = $project->getMembers();
        $this->assertCount(1, $members);
        $this->assertInstanceOf(TeamMember::class, $members[0]);
        $this->assertEquals("Owner", $members[0]->getRole());
        $this->assertRequest("GET", "/v2/project/mOgUt4GM/members");
    }
}
