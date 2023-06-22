<?php

namespace Aternos\ModrinthApi\Test\Client;

use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\SearchProject;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class ClientTest extends TestCase
{
    protected ?ModrinthAPIClient $apiClient = null;

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
        $this->apiClient = new ModrinthAPIClient();
        $this->apiClient->setUserAgent("aternos/php-modrinth-api@1.0.0 (contact@aternos.org)");
    }

    protected function assertValidProjectList($list): void
    {
        $this->assertNotNull($list);
        $this->assertInstanceOf(PaginatedProjectSearchList::class, $list);
        $this->assertNotEmpty($list);
        $this->assertNotNull($list->getResults());
        $this->assertNotEmpty($list->getResults());
    }

    public function testSearchProjects(): void
    {
        $projectList = $this->apiClient->searchProjects();
        $this->assertFalse($projectList->hasPreviousPage());

        $firstProjectOfPages = [];
        for ($i = 0; $i < 3; $i++) {
            $this->assertValidProjectList($projectList);
            $firstProjectOfPages[$i] = $projectList[0];

            foreach ($projectList as $project) {
                $this->assertNotNull($project);
                $this->assertInstanceOf(SearchProject::class, $project);
            }

            $this->assertTrue($projectList->hasNextPage());
            $projectList = $projectList->getNextPage();
        }

        for ($i = 2; $i >= 0; $i--) {
            $this->assertTrue($projectList->hasPreviousPage());
            $projectList = $projectList->getPreviousPage();

            $this->assertValidProjectList($projectList);
            $this->assertEquals($firstProjectOfPages[$i]->getData()->getProjectId(),
                $projectList[0]->getData()->getProjectId());

            foreach ($projectList as $project) {
                $this->assertNotNull($project);
                $this->assertInstanceOf(SearchProject::class, $project);
            }
            $this->assertTrue($projectList->hasNextPage());
        }
        $this->assertFalse($projectList->hasPreviousPage());
    }

    public function testSearchProjectsByType(): void
    {
        $options = new ProjectSearchOptions();
        $options->setFacets(new FacetANDGroup([
            new FacetORGroup([
                new Facet(FacetType::PROJECT_TYPE, "mod"),
            ])
        ]));
        $projectList = $this->apiClient->searchProjects($options);
        $this->assertFalse($projectList->hasPreviousPage());

        $firstProjectOfPages = [];
        for ($i = 0; $i < 3; $i++) {
            $this->assertValidProjectList($projectList);
            $firstProjectOfPages[$i] = $projectList[0];

            foreach ($projectList as $project) {
                $this->assertNotNull($project);
                $this->assertInstanceOf(SearchProject::class, $project);
                $this->assertEquals("mod", $project->getData()->getProjectType());
            }

            $this->assertTrue($projectList->hasNextPage());
            $projectList = $projectList->getNextPage();
        }

        for ($i = 2; $i >= 0; $i--) {
            $this->assertTrue($projectList->hasPreviousPage());
            $projectList = $projectList->getPreviousPage();

            $this->assertValidProjectList($projectList);
            $this->assertEquals($firstProjectOfPages[$i]->getData()->getProjectId(),
                $projectList[0]->getData()->getProjectId());

            foreach ($projectList as $project) {
                $this->assertNotNull($project);
                $this->assertInstanceOf(SearchProject::class, $project);
                $this->assertEquals("mod", $project->getData()->getProjectType());
            }
            $this->assertTrue($projectList->hasNextPage());
        }
        $this->assertFalse($projectList->hasPreviousPage());
    }

    public function testGetProject(): void
    {
        foreach (["mclogs", "6DdCzpTL"] as $idOrSlug) {
            $project = $this->apiClient->getProject($idOrSlug);
            $this->assertEquals("mclogs", $project->getData()->getSlug());
            $this->assertEquals("6DdCzpTL", $project->getData()->getId());
        }
    }

    public function testGetProjectVersionsAndDependencies()
    {
        $project = $this->apiClient->getProject("mclogs");
        $this->assertNotEmpty($project->getDependencies());
        $this->assertNotEmpty($project->getVersions());
        $this->assertNotEmpty($project->getVersions(
            ["forge"],
            ["1.16.5"],
            true,
        ));

    }

    public function testGetProjects()
    {
        $ids = ["6DdCzpTL", "VPo0otUH"];
        $projects = $this->apiClient->getProjects($ids);
        $this->assertSameSize($ids, $projects);
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testGetRandomProjects()
    {
        $projects = $this->apiClient->getRandomProjects(5);
        $this->assertEquals(5, sizeof($projects));
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testCheckProjectValidity()
    {
        foreach (["mclogs", "6DdCzpTL", "motdgg", "VPo0otUH"] as $idOrSlug) {
            $this->assertNotNull($this->apiClient->checkProjectValidity($idOrSlug));
        }

        $this->assertNull($this->apiClient->checkProjectValidity("i-really-hope-no-one-registers-this-slug"));
    }

    public function testGetVersion() {
        $version = $this->apiClient->getVersion("moYTqMH3");
        $this->assertNotNull($version);
        $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
        $this->assertEquals("VPo0otUH", $version->getProject()->getData()->getId());
    }

    public function testGetVersions() {
        $ids = ["moYTqMH3", "gX3fbLHJ"];
        $versions = $this->apiClient->getVersions($ids);
        $this->assertSameSize($ids, $versions);
        foreach ($versions as $version) {
            $this->assertNotNull($version);
            $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
            $this->assertEquals("VPo0otUH", $version->getProject()->getData()->getId());
        }
    }
}