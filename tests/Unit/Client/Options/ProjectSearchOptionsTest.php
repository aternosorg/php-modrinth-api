<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Options;

use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\Options\SearchIndex;
use PHPUnit\Framework\TestCase;

class ProjectSearchOptionsTest extends TestCase
{
    public function testDefaults(): void
    {
        $options = new ProjectSearchOptions();

        $this->assertNull($options->getQuery());
        $this->assertNull($options->getFacets());
        $this->assertEquals(SearchIndex::RELEVANCE, $options->getIndex());
        $this->assertEquals(0, $options->getOffset());
        $this->assertEquals(50, $options->getLimit());
    }

    public function testConstructorArguments(): void
    {
        $facets = new FacetANDGroup([new Facet(FacetType::PROJECT_TYPE, "mod")]);
        $options = new ProjectSearchOptions("sodium", $facets, SearchIndex::DOWNLOADS, 10, 5);

        $this->assertEquals("sodium", $options->getQuery());
        $this->assertSame($facets, $options->getFacets());
        $this->assertEquals(SearchIndex::DOWNLOADS, $options->getIndex());
        $this->assertEquals(10, $options->getOffset());
        $this->assertEquals(5, $options->getLimit());
    }

    public function testConstructorConvertsOrGroupToAndGroup(): void
    {
        $orGroup = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);
        $options = new ProjectSearchOptions(facets: $orGroup);

        $this->assertInstanceOf(FacetANDGroup::class, $options->getFacets());
        $this->assertCount(1, $options->getFacets()->getORGroups());
        $this->assertSame($orGroup, $options->getFacets()->getORGroups()[0]);
    }

    public function testSettersAreChainableAndStoreValues(): void
    {
        $options = new ProjectSearchOptions();
        $facets = new FacetANDGroup();

        $this->assertSame($options, $options->setQuery("iris"));
        $this->assertSame($options, $options->setFacets($facets));
        $this->assertSame($options, $options->setIndex(SearchIndex::NEWEST));
        $this->assertSame($options, $options->setOffset(20));
        $this->assertSame($options, $options->setLimit(100));

        $this->assertEquals("iris", $options->getQuery());
        $this->assertSame($facets, $options->getFacets());
        $this->assertEquals(SearchIndex::NEWEST, $options->getIndex());
        $this->assertEquals(20, $options->getOffset());
        $this->assertEquals(100, $options->getLimit());
    }

    public function testNullableSettersAcceptNull(): void
    {
        $options = new ProjectSearchOptions("iris", new FacetANDGroup());

        $options->setQuery(null);
        $options->setFacets(null);

        $this->assertNull($options->getQuery());
        $this->assertNull($options->getFacets());
    }

    public function testSearchIndexCases(): void
    {
        $this->assertEquals("relevance", SearchIndex::RELEVANCE->value);
        $this->assertEquals("downloads", SearchIndex::DOWNLOADS->value);
        $this->assertEquals("follows", SearchIndex::FOLLOWS->value);
        $this->assertEquals("newest", SearchIndex::NEWEST->value);
        $this->assertEquals("updated", SearchIndex::UPDATED->value);
    }
}
