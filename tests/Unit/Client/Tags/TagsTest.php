<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Tags;

use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\Tags\Category;
use Aternos\ModrinthApi\Client\Tags\DonationPlatform;
use Aternos\ModrinthApi\Client\Tags\GameVersion;
use Aternos\ModrinthApi\Client\Tags\License;
use Aternos\ModrinthApi\Client\Tags\Loader;
use Aternos\ModrinthApi\Client\Tags\ProjectType;
use Aternos\ModrinthApi\Model\CategoryTag;
use Aternos\ModrinthApi\Model\DonationPlatformTag;
use Aternos\ModrinthApi\Model\GameVersionTag;
use Aternos\ModrinthApi\Model\LicenseTag;
use Aternos\ModrinthApi\Model\LoaderTag;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;

/**
 * Tests for the tag wrappers and the SearchableTag trait they share
 */
class TagsTest extends ClientTestCase
{
    protected function emptySearchResponse(): \GuzzleHttp\Psr7\Response
    {
        return $this->jsonResponse([
            "hits" => [],
            "offset" => 0,
            "limit" => 10,
            "total_hits" => 0,
        ]);
    }

    protected function category(ModrinthAPIClient $client): Category
    {
        return new Category($client, new CategoryTag([
            "icon" => "<svg/>",
            "name" => "fabric",
            "project_type" => "mod",
            "header" => "categories",
        ]));
    }

    protected function loader(ModrinthAPIClient $client): Loader
    {
        return new Loader($client, new LoaderTag([
            "icon" => "<svg/>",
            "name" => "forge",
            "supported_project_types" => ["mod", "modpack"],
        ]));
    }

    protected function gameVersion(ModrinthAPIClient $client): GameVersion
    {
        return new GameVersion($client, new GameVersionTag([
            "version" => "1.20.1",
            "version_type" => "release",
            "date" => "2023-06-12T13:25:51+00:00",
            "major" => true,
        ]));
    }

    protected function license(ModrinthAPIClient $client): License
    {
        return new License($client, new LicenseTag([
            "short" => "MIT",
            "name" => "MIT License",
        ]));
    }

    public function testCategoryToFacet(): void
    {
        $facet = $this->category($this->createClient())->toFacet();

        $this->assertInstanceOf(Facet::class, $facet);
        $this->assertEquals(FacetType::CATEGORIES, $facet->getType());
        $this->assertEquals("fabric", $facet->getValue());
        $this->assertEquals("categories = fabric", $facet->serialize());
    }

    public function testLoaderToFacet(): void
    {
        $facet = $this->loader($this->createClient())->toFacet();

        $this->assertEquals(FacetType::CATEGORIES, $facet->getType());
        $this->assertEquals("forge", $facet->getValue());
    }

    public function testGameVersionToFacet(): void
    {
        $facet = $this->gameVersion($this->createClient())->toFacet();

        $this->assertEquals(FacetType::VERSIONS, $facet->getType());
        $this->assertEquals("1.20.1", $facet->getValue());
    }

    public function testLicenseToFacet(): void
    {
        $facet = $this->license($this->createClient())->toFacet();

        $this->assertEquals(FacetType::LICENSE, $facet->getType());
        $this->assertEquals("MIT", $facet->getValue());
    }

    public function testProjectTypeGetNameAndToFacet(): void
    {
        $projectType = new ProjectType($this->createClient(), "modpack");

        $this->assertEquals("modpack", $projectType->getName());
        $this->assertEquals(FacetType::PROJECT_TYPE, $projectType->toFacet()->getType());
        $this->assertEquals("modpack", $projectType->toFacet()->getValue());
    }

    public function testDonationPlatformCopiesTheModelData(): void
    {
        $model = new DonationPlatformTag(["short" => "patreon", "name" => "Patreon"]);
        $platform = new DonationPlatform($this->createClient(), $model);

        $this->assertInstanceOf(DonationPlatform::class, $platform);
        $this->assertEquals("patreon", $platform->getShort());
        $this->assertEquals("Patreon", $platform->getName());
    }

    public function testSearchProjectsAddsTheTagFacet(): void
    {
        $client = $this->createClient([$this->emptySearchResponse()]);
        $list = $this->category($client)->searchProjects();

        $this->assertInstanceOf(PaginatedProjectSearchList::class, $list);
        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals('[["categories = fabric"]]', $query["facets"]);
    }

    public function testSearchProjectsKeepsExistingFacets(): void
    {
        $client = $this->createClient([$this->emptySearchResponse()]);
        $options = new ProjectSearchOptions(facets: new FacetANDGroup([
            new FacetORGroup([new Facet(FacetType::PROJECT_TYPE, "mod")]),
        ]));

        $this->gameVersion($client)->searchProjects($options);

        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals('[["project_type = mod"],["versions = 1.20.1"]]', $query["facets"]);
    }

    public function testSearchProjectsPassesTheRemainingOptions(): void
    {
        $client = $this->createClient([$this->emptySearchResponse()]);
        $options = (new ProjectSearchOptions("sodium"))->setLimit(3)->setOffset(6);

        $this->loader($client)->searchProjects($options);

        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals("sodium", $query["query"]);
        $this->assertEquals("3", $query["limit"]);
        $this->assertEquals("6", $query["offset"]);
        $this->assertEquals('[["categories = forge"]]', $query["facets"]);
    }

    public function testProjectTypeSearchProjects(): void
    {
        $client = $this->createClient([$this->emptySearchResponse()]);
        $projectType = new ProjectType($client, "shader");

        $projectType->searchProjects();

        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals('[["project_type = shader"]]', $query["facets"]);
    }

    public function testLicenseSearchProjects(): void
    {
        $client = $this->createClient([$this->emptySearchResponse()]);

        $this->license($client)->searchProjects();

        parse_str($this->getRequest()->getUri()->getQuery(), $query);
        $this->assertEquals('[["license = MIT"]]', $query["facets"]);
    }
}
