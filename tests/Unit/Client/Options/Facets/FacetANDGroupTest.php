<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Options\Facets;

use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FacetANDGroupTest extends TestCase
{
    public function testEmptyByDefault(): void
    {
        $group = new FacetANDGroup();

        $this->assertEquals([], $group->getORGroups());
        $this->assertEquals("[]", $group->serialize());
    }

    public function testConstructFromOrGroups(): void
    {
        $orGroup = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);
        $group = new FacetANDGroup([$orGroup]);

        $this->assertSame([$orGroup], $group->getORGroups());
    }

    public function testConstructFromSingleFacetsWrapsThemInOrGroups(): void
    {
        $facet = new Facet(FacetType::PROJECT_TYPE, "mod");
        $group = new FacetANDGroup([$facet]);

        $this->assertCount(1, $group->getORGroups());
        $this->assertInstanceOf(FacetORGroup::class, $group->getORGroups()[0]);
        $this->assertSame([$facet], $group->getORGroups()[0]->getFacets());
    }

    public function testConstructFromArraysOfFacets(): void
    {
        $facets = [
            new Facet(FacetType::CATEGORIES, "fabric"),
            new Facet(FacetType::CATEGORIES, "forge"),
        ];
        $group = new FacetANDGroup([$facets]);

        $this->assertCount(1, $group->getORGroups());
        $this->assertSame($facets, $group->getORGroups()[0]->getFacets());
    }

    public function testConstructFromMixedInput(): void
    {
        $orGroup = new FacetORGroup([new Facet(FacetType::VERSIONS, "1.20.1")]);
        $facet = new Facet(FacetType::PROJECT_TYPE, "mod");
        $facetArray = [new Facet(FacetType::CATEGORIES, "fabric")];

        $group = new FacetANDGroup([$orGroup, $facet, $facetArray]);
        $this->assertCount(3, $group->getORGroups());
        $this->assertEquals(
            '[["versions = 1.20.1"],["project_type = mod"],["categories = fabric"]]',
            $group->serialize()
        );
    }

    public function testConstructFromScalarThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("FacetANDGroup can only be constructed from FacetORGroup[], Facet[][] or Facet[]");

        new FacetANDGroup(["not a facet"]);
    }

    public function testConstructFromArrayOfNonFacetsThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("FacetANDGroup can only be constructed from FacetORGroup[], Facet[][] or Facet[]");

        new FacetANDGroup([["not a facet"]]);
    }

    public function testSetORGroups(): void
    {
        $group = new FacetANDGroup([new Facet(FacetType::PROJECT_TYPE, "mod")]);
        $orGroup = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);

        $this->assertSame($group, $group->setORGroups([$orGroup]));
        $this->assertSame([$orGroup], $group->getORGroups());
    }

    public function testAddORGroup(): void
    {
        $group = new FacetANDGroup();
        $orGroup = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);

        $this->assertSame($group, $group->addORGroup($orGroup));
        $this->assertSame([$orGroup], $group->getORGroups());
    }

    public function testAddORGroups(): void
    {
        $group = new FacetANDGroup();
        $first = new FacetORGroup([new Facet(FacetType::CATEGORIES, "fabric")]);
        $second = new FacetORGroup([new Facet(FacetType::VERSIONS, "1.20.1")]);

        $this->assertSame($group, $group->addORGroups($first, $second));
        $this->assertSame([$first, $second], $group->getORGroups());
    }

    public function testSerializeProducesNestedJsonArrays(): void
    {
        $group = new FacetANDGroup([
            new FacetORGroup([
                new Facet(FacetType::CATEGORIES, "fabric"),
                new Facet(FacetType::CATEGORIES, "forge"),
            ]),
            new FacetORGroup([new Facet(FacetType::VERSIONS, "1.20.1")]),
        ]);

        $this->assertEquals(
            '[["categories = fabric","categories = forge"],["versions = 1.20.1"]]',
            $group->serialize()
        );
    }
}
