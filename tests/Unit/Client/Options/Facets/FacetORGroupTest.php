<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Options\Facets;

use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use PHPUnit\Framework\TestCase;

class FacetORGroupTest extends TestCase
{
    public function testEmptyByDefault(): void
    {
        $group = new FacetORGroup();

        $this->assertEquals([], $group->getFacets());
        $this->assertEquals([], $group->serialize());
    }

    public function testConstructorAndGetFacets(): void
    {
        $facet = new Facet(FacetType::CATEGORIES, "fabric");
        $group = new FacetORGroup([$facet]);

        $this->assertSame([$facet], $group->getFacets());
    }

    public function testSetFacets(): void
    {
        $group = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);
        $facet = new Facet(FacetType::CATEGORIES, "forge");

        $this->assertSame($group, $group->setFacets([$facet]));
        $this->assertSame([$facet], $group->getFacets());
    }

    public function testAddFacet(): void
    {
        $group = new FacetORGroup();
        $facet = new Facet(FacetType::CATEGORIES, "fabric");

        $this->assertSame($group, $group->addFacet($facet));
        $this->assertSame([$facet], $group->getFacets());
    }

    public function testAddFacets(): void
    {
        $group = new FacetORGroup();
        $first = new Facet(FacetType::CATEGORIES, "fabric");
        $second = new Facet(FacetType::CATEGORIES, "forge");

        $this->assertSame($group, $group->addFacets($first, $second));
        $this->assertSame([$first, $second], $group->getFacets());
    }

    public function testAddMultiple(): void
    {
        $group = new FacetORGroup();

        $this->assertSame($group, $group->addMultiple(FacetType::VERSIONS, "1.20.1", "1.20.2"));
        $this->assertCount(2, $group->getFacets());
        $this->assertEquals(["versions = 1.20.1", "versions = 1.20.2"], $group->serialize());
    }

    public function testToANDGroup(): void
    {
        $group = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);
        $andGroup = $group->toANDGroup();

        $this->assertInstanceOf(FacetANDGroup::class, $andGroup);
        $this->assertSame([$group], $andGroup->getORGroups());
    }

    public function testSerialize(): void
    {
        $group = new FacetORGroup([
            new Facet(FacetType::CATEGORIES, "fabric"),
            new Facet(FacetType::CATEGORIES, "forge"),
        ]);

        $this->assertEquals(["categories = fabric", "categories = forge"], $group->serialize());
    }
}
