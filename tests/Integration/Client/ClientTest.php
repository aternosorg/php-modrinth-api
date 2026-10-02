<?php

namespace Aternos\ModrinthApi\Tests\Integration\Client;

use Aternos\ModrinthApi\Client\HashAlgorithm;
use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetOperation;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Client\NeoForgeUpdate;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\Options\SearchIndex;
use Aternos\ModrinthApi\Client\ProjectDependencies;
use Aternos\ModrinthApi\Client\SearchProject;
use Aternos\ModrinthApi\Client\Tags\GameVersion;
use Aternos\ModrinthApi\Client\Tags\ProjectType;
use Aternos\ModrinthApi\Client\TeamMember;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Model\DisclosureTypeEnum;
use Aternos\ModrinthApi\Model\EnvironmentEnum;
use Aternos\ModrinthApi\Model\ForgeUpdates;
use Aternos\ModrinthApi\Model\Statistics;
use PHPUnit\Framework\Attributes\DataProvider;
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
        $this->apiClient->setUserAgent("aternos/php-modrinth-api@2.0.0 (contact@aternos.org)");
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
            $this->assertEquals($firstProjectOfPages[$i]->getProjectId(),
                $projectList[0]->getProjectId());

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
                $this->assertEquals("mod", $project->getProjectType());
            }

            $this->assertTrue($projectList->hasNextPage());
            $projectList = $projectList->getNextPage();
        }

        for ($i = 2; $i >= 0; $i--) {
            $this->assertTrue($projectList->hasPreviousPage());
            $projectList = $projectList->getPreviousPage();

            $this->assertValidProjectList($projectList);
            $this->assertEquals($firstProjectOfPages[$i]->getProjectId(),
                $projectList[0]->getProjectId());

            foreach ($projectList as $project) {
                $this->assertNotNull($project);
                $this->assertInstanceOf(SearchProject::class, $project);
                $this->assertEquals("mod", $project->getProjectType());
            }
            $this->assertTrue($projectList->hasNextPage());
        }
        $this->assertFalse($projectList->hasPreviousPage());
    }

    public function testSearchProjectsByDownloadCount(): void
    {
        $options = new ProjectSearchOptions();
        $options->setFacets(new FacetANDGroup([
            new FacetORGroup([
                new Facet(FacetType::DOWNLOADS, 5000, FacetOperation::LESS_THAN),
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
                $this->assertLessThanOrEqual(5000, $project->getDownloads());
            }

            $this->assertTrue($projectList->hasNextPage());
            $projectList = $projectList->getNextPage();
        }

        for ($i = 2; $i >= 0; $i--) {
            $this->assertTrue($projectList->hasPreviousPage());
            $projectList = $projectList->getPreviousPage();

            $this->assertValidProjectList($projectList);
            $this->assertEquals($firstProjectOfPages[$i]->getProjectId(),
                $projectList[0]->getProjectId());

            foreach ($projectList as $project) {
                $this->assertNotNull($project);
                $this->assertInstanceOf(SearchProject::class, $project);
                $this->assertLessThanOrEqual(5000, $project->getDownloads());
            }
            $this->assertTrue($projectList->hasNextPage());
        }
        $this->assertFalse($projectList->hasPreviousPage());
    }

    public function testGetProject(): void
    {
        foreach (["mclogs", "6DdCzpTL"] as $idOrSlug) {
            $project = $this->apiClient->getProject($idOrSlug);
            $this->assertEquals("mclogs", $project->getSlug());
            $this->assertEquals("6DdCzpTL", $project->getId());
        }
    }

    public function testGetProjectVersionsAndDependencies(): void
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

    public function testGetProjects(): void
    {
        $ids = ["6DdCzpTL", "VPo0otUH"];
        $projects = $this->apiClient->getProjects($ids);
        $this->assertSameSize($ids, $projects);
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testGetRandomProjects(): void
    {
        $projects = $this->apiClient->getRandomProjects(5);
        $this->assertEquals(5, sizeof($projects));
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testCheckProjectValidity(): void
    {
        foreach (["mclogs", "6DdCzpTL", "motdgg", "VPo0otUH"] as $idOrSlug) {
            $this->assertNotNull($this->apiClient->checkProjectValidity($idOrSlug));
        }

        $this->assertNull($this->apiClient->checkProjectValidity("i-really-hope-no-one-registers-this-slug"));
    }

    public function testGetVersion(): void
    {
        $version = $this->apiClient->getVersion("moYTqMH3");
        $this->assertNotNull($version);
        $this->assertEquals("VPo0otUH", $version->getProjectId());
        $this->assertEquals("VPo0otUH", $version->getProject()->getId());
    }

    public function testGetVersions(): void
    {
        $ids = ["moYTqMH3", "gX3fbLHJ"];
        $versions = $this->apiClient->getVersions($ids);
        $this->assertSameSize($ids, $versions);
        foreach ($versions as $version) {
            $this->assertNotNull($version);
            $this->assertEquals("VPo0otUH", $version->getProjectId());
            $this->assertEquals("VPo0otUH", $version->getProject()->getId());
        }
    }

    public function testGetVersionFromHash(): void
    {
        $hashes = [
            HashAlgorithm::SHA1->value => "5952253d61e199e82eb852c5824c3981b29b209d",
            HashAlgorithm::SHA512->value => "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
        ];

        foreach ($hashes as $algorithm => $hash) {
            $version = $this->apiClient->getVersionFromHash($hash, HashAlgorithm::from($algorithm));
            $this->assertNotNull($version);
            $this->assertEquals("gzWt3g3d", $version->getId());
            $this->assertEquals("VPo0otUH", $version->getProjectId());
        }
    }

    public function testGetVersionsFromHashes(): void
    {
        $hashes = [
            "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
            "93dc1220f2e15c9a549d260277acca43642781ab4e72bcd0355a151fd7ef7a5cf6782059666cc8d02176bb95699277158e7682d6a68a927a5f5d621137364f9c",
        ];


        $versions = $this->apiClient->getVersionsFromHashes($hashes, HashAlgorithm::SHA512);
        $this->assertSameSize($hashes, $versions);
        foreach ($versions as $version) {
            $this->assertNotNull($version);
            $this->assertEquals("VPo0otUH", $version->getProjectId());
        }
    }

    public function testGetLatestVersionFromHash(): void
    {
        $version = $this->apiClient->getLatestVersionFromHash(
            "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
            ["spigot"],
            ["1.20.1"],
            HashAlgorithm::SHA512
        );
        $this->assertNotNull($version);
        $this->assertEquals("VPo0otUH", $version->getProjectId());
        $this->assertEquals(
            $version->getProject()->fetchProjectVersions(["spigot"], ["1.20.1"])[0]->getId(),
            $version->getId(),
        );
    }

    public function testGetLatestVersionsFromHashes(): void
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
            $this->assertEquals("VPo0otUH", $version->getProjectId());
            $this->assertEquals(
                $version->getProject()->fetchProjectVersions(["spigot"], ["1.20.1"])[0]->getId(),
                $version->getId(),
            );
        }
    }

    public function testGetUser(): void
    {
        $user = $this->apiClient->getUser("Julian");
        $this->assertNotNull($user);
        $this->assertEquals("Julian", $user->getUsername());
        $projects = $user->getProjects();
        $this->assertNotNull($projects);
    }

    public function testGetUsers(): void
    {
        $ids = ["b1AIbOxO", "ySB3MPni"];
        $users = $this->apiClient->getUsers($ids);
        $this->assertSameSize($ids, $users);
        foreach ($users as $user) {
            $this->assertNotNull($user);
        }
    }

    public function testGetProjectMembers(): void
    {
        $members = $this->apiClient->getProjectMembers("VPo0otUH");
        $this->assertNotNull($members);
        $this->assertNotEmpty($members);
        foreach ($members as $member) {
            $this->assertNotNull($member);
        }
    }

    public function testGetTeamMembers(): void
    {
        $members = $this->apiClient->getTeamMembers("ThaUQrOs");
        $this->assertNotEmpty($members);
        foreach ($members as $member) {
            $this->assertNotNull($member);
        }
    }

    public function testGetTeams(): void
    {
        $teams = $this->apiClient->getTeams(["ThaUQrOs"]);
        $this->assertNotEmpty($teams);
        foreach ($teams as $team) {
            $this->assertNotNull($team);
            $this->assertIsArray($team);
            $this->assertNotEmpty($team);
        }
    }

    public function testGetCategories(): void
    {
        $items = $this->apiClient->getCategories();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }

        $projects = $items[0]->searchProjects();
        $this->assertNotEmpty($projects);
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testGetLoaders(): void
    {
        $items = $this->apiClient->getLoaders();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }

        $projects = $items[0]->searchProjects();
        $this->assertNotEmpty($projects);
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testGetGameVersions(): void
    {
        $gameVersions = $this->apiClient->getGameVersions();
        $this->assertNotEmpty($gameVersions);

        foreach ($gameVersions as $gameVersion) {
            $this->assertNotNull($gameVersion);
        }

        $latestRelease = array_find($gameVersions, function (GameVersion $gameVersion) {
            return $gameVersion->getVersionType() === "release";
        });

        $projects = $latestRelease->searchProjects();
        $this->assertNotEmpty($projects);
        foreach ($projects as $project) {
            $this->assertNotNull($project);
        }
    }

    public function testGetDonationPlatforms(): void
    {
        $items = $this->apiClient->getDonationPlatforms();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }

    public function testGetReportTypes(): void
    {
        $items = $this->apiClient->getReportTypes();
        $this->assertNotEmpty($items);

        foreach ($items as $item) {
            $this->assertNotNull($item);
        }
    }

    public function testGetProjectDependencies(): void
    {
        $dependencies = $this->apiClient->getProjectDependencies("mclogs");
        $this->assertInstanceOf(ProjectDependencies::class, $dependencies);
        $this->assertIsArray($dependencies->getProjects());
        $this->assertIsArray($dependencies->getVersions());
    }

    public function testGetProjectVersions(): void
    {
        $versions = $this->apiClient->getProjectVersions("mclogs");
        $this->assertNotEmpty($versions);

        foreach ($versions as $version) {
            $this->assertInstanceOf(Version::class, $version);
            $this->assertEquals("6DdCzpTL", $version->getProjectId());
        }
    }

    public function testGetProjectVersionFromIdOrNumber(): void
    {
        $versions = $this->apiClient->getProjectVersions("mclogs");
        $this->assertNotEmpty($versions);
        $expected = $versions[0];

        $byId = $this->apiClient->getProjectVersionFromIdOrNumber("mclogs", $expected->getId());
        $this->assertInstanceOf(Version::class, $byId);
        $this->assertEquals($expected->getId(), $byId->getId());
        $this->assertEquals("6DdCzpTL", $byId->getProjectId());

        // version numbers are not unique across loaders, so this may resolve to another version
        $byNumber = $this->apiClient->getProjectVersionFromIdOrNumber("mclogs", $expected->getVersionNumber());
        $this->assertInstanceOf(Version::class, $byNumber);
        $this->assertEquals($expected->getVersionNumber(), $byNumber->getVersionNumber());
        $this->assertEquals("6DdCzpTL", $byNumber->getProjectId());
    }

    public function testGetLicenseText(): void
    {
        $text = $this->apiClient->getLicenseText("MIT");
        $this->assertNotEmpty($text);
        $this->assertStringContainsString("MIT License", $text);
    }

    public function testGetProjectTypes(): void
    {
        $projectTypes = $this->apiClient->getProjectTypes();
        $this->assertNotEmpty($projectTypes);

        foreach ($projectTypes as $projectType) {
            $this->assertInstanceOf(ProjectType::class, $projectType);
            $this->assertNotEmpty($projectType->getName());
        }

        $names = array_map(fn(ProjectType $type) => $type->getName(), $projectTypes);
        $this->assertContains("mod", $names);
    }

    public function testProjectTypeSearchProjects(): void
    {
        $projectType = array_find(
            $this->apiClient->getProjectTypes(),
            fn(ProjectType $type) => $type->getName() === "mod"
        );
        $this->assertNotNull($projectType);

        $projects = $projectType->searchProjects(new ProjectSearchOptions(limit: 5));
        $this->assertValidProjectList($projects);
        foreach ($projects as $project) {
            $this->assertEquals("mod", $project->getProjectType());
        }
    }

    public function testGetSideTypes(): void
    {
        $sideTypes = $this->apiClient->getSideTypes();
        $this->assertNotEmpty($sideTypes);

        foreach ($sideTypes as $sideType) {
            $this->assertIsString($sideType);
        }
        $this->assertContains("required", $sideTypes);
        $this->assertContains("optional", $sideTypes);
        $this->assertContains("unsupported", $sideTypes);
    }

    public function testGetStatistics(): void
    {
        $statistics = $this->apiClient->getStatistics();
        $this->assertInstanceOf(Statistics::class, $statistics);
        $this->assertGreaterThan(0, $statistics->getProjects());
        $this->assertGreaterThan(0, $statistics->getVersions());
        $this->assertGreaterThan(0, $statistics->getFiles());
        $this->assertGreaterThan(0, $statistics->getAuthors());
    }

    public function testGetForgeUpdates(): void
    {
        $updates = $this->apiClient->getForgeUpdates("mclogs");
        $this->assertInstanceOf(ForgeUpdates::class, $updates);
        $this->assertEquals("https://modrinth.com/mod/mclogs", $updates->getHomepage());
    }

    public function testGetForgeUpdatesWithNeoForgeFilter(): void
    {
        foreach (NeoForgeUpdate::cases() as $filter) {
            $updates = $this->apiClient->getForgeUpdates("mclogs", $filter);
            $this->assertInstanceOf(ForgeUpdates::class, $updates);
            $this->assertEquals("https://modrinth.com/mod/mclogs", $updates->getHomepage());
        }
    }

    public function testProjectMembersAndDependenciesFromProject(): void
    {
        $project = $this->apiClient->getProject("mclogs");

        $members = $project->getMembers();
        $this->assertNotEmpty($members);
        foreach ($members as $member) {
            $this->assertInstanceOf(TeamMember::class, $member);
            $this->assertNotEmpty($member->getUser()->getUsername());
        }

        $this->assertInstanceOf(ProjectDependencies::class, $project->getDependencies());
    }

    public function testGetLatestVersionFromHashWithVersionTypes(): void
    {
        $version = $this->apiClient->getLatestVersionFromHash(
            "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
            ["spigot"],
            ["1.20.1"],
            HashAlgorithm::SHA512,
            ["release"],
        );

        $this->assertNotNull($version);
        $this->assertEquals("VPo0otUH", $version->getProjectId());
        $this->assertEquals("release", $version->getVersionType());
    }

    public function testGetLatestVersionsFromHashesWithVersionTypes(): void
    {
        $versions = $this->apiClient->getLatestVersionsFromHashes(
            [
                "6800de4cf254fd74e0e9b06b34dc87b16624ea838edc795321fb9d6777356d366b47bb1dc736bb6a700861f3619810bd190b10987a32f64dfd261a5d69a2bd8f",
                "93dc1220f2e15c9a549d260277acca43642781ab4e72bcd0355a151fd7ef7a5cf6782059666cc8d02176bb95699277158e7682d6a68a927a5f5d621137364f9c",
            ],
            ["spigot"],
            ["1.20.1"],
            HashAlgorithm::SHA512,
            ["release"],
        );

        $this->assertNotEmpty($versions);
        foreach ($versions as $version) {
            $this->assertEquals("VPo0otUH", $version->getProjectId());
            $this->assertEquals("release", $version->getVersionType());
        }
    }

    /**
     * The facet types added for the fields that were introduced after v3.2.1.
     * These are checked against the live search index because the API silently
     * accepts facet types it does not actually filter on.
     * @return array<string, array{0: FacetType, 1: string}>
     */
    public static function newFacetTypeProvider(): array
    {
        return [
            "environment" => [FacetType::ENVIRONMENT, EnvironmentEnum::SERVER_ONLY->value],
            "all project types" => [FacetType::ALL_PROJECT_TYPES, "shader"],
            "disclosure types" => [FacetType::DISCLOSURE_TYPES, DisclosureTypeEnum::AI_CONTENT->value],
        ];
    }

    #[DataProvider("newFacetTypeProvider")]
    public function testSearchByNewFacetTypeReturnsResults(FacetType $type, string $value): void
    {
        $options = new ProjectSearchOptions(limit: 5);
        $options->setFacets(new FacetANDGroup([
            new FacetORGroup([new Facet($type, $value)]),
        ]));

        $projects = $this->apiClient->searchProjects($options);
        $this->assertValidProjectList($projects);
    }

    public function testSearchByEnvironmentFacetFiltersResults(): void
    {
        $options = new ProjectSearchOptions(limit: 10);
        $options->setFacets(new FacetANDGroup([
            new FacetORGroup([new Facet(FacetType::ENVIRONMENT, EnvironmentEnum::SERVER_ONLY->value)]),
        ]));

        $projects = $this->apiClient->searchProjects($options);
        $this->assertValidProjectList($projects);

        foreach ($projects as $project) {
            $this->assertContains(
                EnvironmentEnum::SERVER_ONLY,
                $project->getEnvironment(),
                $project->getSlug() . " does not support the server_only environment"
            );
        }
    }

    public function testSearchByAllProjectTypesFacetFiltersResults(): void
    {
        $options = new ProjectSearchOptions(limit: 10);
        $options->setFacets(new FacetANDGroup([
            new FacetORGroup([new Facet(FacetType::ALL_PROJECT_TYPES, "plugin")]),
        ]));

        $projects = $this->apiClient->searchProjects($options);
        $this->assertValidProjectList($projects);

        foreach ($projects as $project) {
            $this->assertContains("plugin", $project->getAllProjectTypes());
            // the single project type is always one of the types in all_project_types
            $this->assertContains($project->getProjectType(), $project->getAllProjectTypes());
        }
    }

    /**
     * all_project_types and project_type are different fields on a search result, but
     * the same filter: the project_type facet already matches any of a project's types.
     */
    public function testAllProjectTypesAndProjectTypeFacetsAreEquivalent(): void
    {
        $search = function (FacetType $type): array {
            $options = new ProjectSearchOptions(limit: 20);
            $options->setFacets(new FacetANDGroup([
                new FacetORGroup([new Facet($type, "plugin")]),
            ]));
            $options->setIndex(SearchIndex::DOWNLOADS);

            return array_map(
                fn(SearchProject $project) => $project->getProjectId(),
                $this->apiClient->searchProjects($options)->getResults()
            );
        };

        $byProjectType = $search(FacetType::PROJECT_TYPE);
        $byAllProjectTypes = $search(FacetType::ALL_PROJECT_TYPES);

        $this->assertNotEmpty($byProjectType);
        $this->assertEquals($byProjectType, $byAllProjectTypes);
    }

    /**
     * The color facet is not mentioned in the Modrinth documentation, this pins that it
     * still works. The colour is an RGB integer that Modrinth derives from the project
     * icon, so it supports the numeric comparison operators.
     */
    public function testColorFacet(): void
    {
        $reference = $this->apiClient->searchProjects(new ProjectSearchOptions(limit: 1))[0];
        $color = $reference->getColor();
        $this->assertNotNull($color, "the first search result has no color to filter by");

        $search = function (Facet $facet): PaginatedProjectSearchList {
            $options = new ProjectSearchOptions(limit: 10);
            $options->setFacets(new FacetANDGroup([new FacetORGroup([$facet])]));
            return $this->apiClient->searchProjects($options);
        };

        $equal = $search(new Facet(FacetType::COLOR, (string)$color));
        $this->assertValidProjectList($equal);
        foreach ($equal as $project) {
            $this->assertEquals($color, $project->getColor());
        }

        $notEqual = $search(new Facet(FacetType::COLOR, (string)$color, FacetOperation::NOT_EQUALS));
        $this->assertValidProjectList($notEqual);
        foreach ($notEqual as $project) {
            $this->assertNotEquals($color, $project->getColor());
        }

        $greater = $search(new Facet(FacetType::COLOR, "0", FacetOperation::GREATER_THAN));
        $this->assertValidProjectList($greater);
        foreach ($greater as $project) {
            $this->assertGreaterThan(0, $project->getColor());
        }
    }

    public function testProjectIdFacetIsCaseSensitive(): void
    {
        $search = function (string $value): int {
            $options = new ProjectSearchOptions(limit: 1);
            $options->setFacets(new FacetANDGroup([
                new FacetORGroup([new Facet(FacetType::PROJECT_ID, $value)]),
            ]));
            return count($this->apiClient->searchProjects($options)->getResults());
        };

        // AANobbMI -> sodium. Project ids are matched exactly, so an id that was
        // lowercased on the way in silently matches nothing.
        $this->assertEquals(1, $search("AANobbMI"));
        $this->assertEquals(0, $search(strtolower("AANobbMI")));
    }




    public function testGetVersionAuthor(): void
    {
        $version = $this->apiClient->getVersion("moYTqMH3");

        $author = $version->getAuthor();
        $this->assertInstanceOf(User::class, $author);
        $this->assertEquals($version->getAuthorId(), $author->getId());
        $this->assertNotEmpty($author->getUsername());
    }

    public function testFetchAuthorOfSearchResult(): void
    {
        $projects = $this->apiClient->searchProjects(new ProjectSearchOptions(limit: 5));
        $this->assertValidProjectList($projects);

        $searchProject = array_find(
            $projects->getResults(),
            fn(SearchProject $project) => $project->getAuthorId() !== null
        );
        $this->assertNotNull($searchProject, "no search result carried an author id");

        $author = $searchProject->fetchAuthor();
        $this->assertInstanceOf(User::class, $author);
        $this->assertEquals($searchProject->getAuthorId(), $author->getId());

        // the author is a user even when the project belongs to an organization,
        // getAuthor() returns that user's name without requesting anything
        $this->assertEquals($searchProject->getAuthor(), $author->getUsername());
    }

    public function testFetchAuthorOfOrganizationOwnedSearchResult(): void
    {
        $searchProject = null;
        $projects = $this->apiClient->searchProjects(new ProjectSearchOptions(limit: 100));
        foreach ($projects as $project) {
            if ($project->getOrganizationId() !== null && $project->getAuthorId() !== null) {
                $searchProject = $project;
                break;
            }
        }
        $this->assertNotNull($searchProject, "no search result was owned by an organization");

        $author = $searchProject->fetchAuthor();
        $this->assertInstanceOf(User::class, $author);
        $this->assertEquals($searchProject->getAuthorId(), $author->getId());
        $this->assertNotEquals($searchProject->getOrganizationId(), $author->getId());
    }

    public function testGetTeamMembersFromTeamMember(): void
    {
        $members = $this->apiClient->getProjectMembers("VPo0otUH");
        $this->assertNotEmpty($members);

        $teamMembers = $members[0]->getTeamMembers();
        $this->assertNotEmpty($teamMembers);
        foreach ($teamMembers as $teamMember) {
            $this->assertInstanceOf(TeamMember::class, $teamMember);
            $this->assertEquals($members[0]->getTeamId(), $teamMember->getTeamId());
        }
    }

    public function testSearchProjectResultsCanBeExpanded(): void
    {
        $projects = $this->apiClient->searchProjects(new ProjectSearchOptions(limit: 1));
        $this->assertValidProjectList($projects);

        $searchProject = $projects[0];
        $fullProject = $searchProject->getFullProject();
        $this->assertEquals($searchProject->getProjectId(), $fullProject->getId());
    }
}
