<?php

namespace Aternos\ModrinthApi\Test\Client;

use Aternos\ModrinthApi\Client\HashAlgorithm;
use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\SearchProject;
use PHPUnit\Framework\TestCase;

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
        // This is broken on the API side: https://github.com/modrinth/labrinth/issues/548
        // $this->assertEquals(5, sizeof($projects));
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

    public function testGetVersion()
    {
        $version = $this->apiClient->getVersion("moYTqMH3");
        $this->assertNotNull($version);
        $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
        $this->assertEquals("VPo0otUH", $version->getProject()->getData()->getId());
    }

    public function testGetVersions()
    {
        $ids = ["moYTqMH3", "gX3fbLHJ"];
        $versions = $this->apiClient->getVersions($ids);
        $this->assertSameSize($ids, $versions);
        foreach ($versions as $version) {
            $this->assertNotNull($version);
            $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
            $this->assertEquals("VPo0otUH", $version->getProject()->getData()->getId());
        }
    }

    public function testGetVersionFromHash()
    {
        $hashes = [
            HashAlgorithm::SHA1->value => "5952253d61e199e82eb852c5824c3981b29b209d",
            HashAlgorithm::SHA512->value => "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
        ];

        foreach ($hashes as $algorithm => $hash) {
            $version = $this->apiClient->getVersionFromHash($hash, HashAlgorithm::from($algorithm));
            $this->assertNotNull($version);
            $this->assertEquals("gzWt3g3d", $version->getData()->getId());
            $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
        }
    }

    public function testGetVersionsFromHashes()
    {
        $hashes = [
            "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
            "93dc1220f2e15c9a549d260277acca43642781ab4e72bcd0355a151fd7ef7a5cf6782059666cc8d02176bb95699277158e7682d6a68a927a5f5d621137364f9c",
        ];


        $versions = $this->apiClient->getVersionsFromHashes($hashes, HashAlgorithm::SHA512);
        $this->assertSameSize($hashes, $versions);
        foreach ($versions as $version) {
            $this->assertNotNull($version);
            $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
        }
    }

    public function testGetLatestVersionFromHash()
    {
        $version = $this->apiClient->getLatestVersionFromHash(
            "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
            ["spigot"],
            ["1.20.1"],
            HashAlgorithm::SHA512
        );
        $this->assertNotNull($version);
        $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
        $this->assertEquals(
            $version->getProject()->getVersions(["spigot"], ["1.20.1"])[0]->getData()->getId(),
            $version->getData()->getId(),
        );
    }

    public function testGetLatestVersionsFromHashes()
    {
        $versions = $this->apiClient->getLatestVersionsFromHashes(
            [
                "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
                "93dc1220f2e15c9a549d260277acca43642781ab4e72bcd0355a151fd7ef7a5cf6782059666cc8d02176bb95699277158e7682d6a68a927a5f5d621137364f9c",
            ],
            ["spigot"],
            ["1.20.1"],
            HashAlgorithm::SHA512
        );
        foreach ($versions as $version) {
            $this->assertNotNull($version);
            $this->assertEquals("VPo0otUH", $version->getData()->getProjectId());
            $this->assertEquals(
                $version->getProject()->getVersions(["spigot"], ["1.20.1"])[0]->getData()->getId(),
                $version->getData()->getId(),
            );
        }
    }

    public function testGetUser()
    {
        $user = $this->apiClient->getUser("JulianVennen");
        $this->assertNotNull($user);
        $this->assertEquals("JulianVennen", $user->getData()->getUsername());
        $projects = $user->getProjects();
        $this->assertNotNull($projects);
    }

    public function testGetUsers()
    {
        $ids = ["b1AIbOxO", "ySB3MPni"];
        $users = $this->apiClient->getUsers($ids);
        $this->assertSameSize($ids, $users);
        foreach ($users as $user) {
            $this->assertNotNull($user);
        }
    }

    public function testGetProjectMembers()
    {
        $members = $this->apiClient->getProjectMembers("VPo0otUH");
        $this->assertNotNull($members);
        $this->assertNotEmpty($members);
        foreach ($members as $member) {
            $this->assertNotNull($member);
        }
    }

    public function testGetCategories()
    {
        $items = $this->apiClient->getCategories();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }

    public function testGetLoaders()
    {
        $items = $this->apiClient->getLoaders();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }

    public function testGetGameVersions()
    {
        $items = $this->apiClient->getGameVersions();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }

    public function testGetLicenses()
    {
        $items = $this->apiClient->getLicenses();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }

    public function testGetReportTypes()
    {
        $items = $this->apiClient->getReportTypes();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }
}