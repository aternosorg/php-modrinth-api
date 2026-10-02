<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Options\Facets;

use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetOperation;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FacetTest extends TestCase
{
    public function testGetters(): void
    {
        $facet = new Facet(FacetType::CATEGORIES, "fabric");

        $this->assertEquals(FacetType::CATEGORIES, $facet->getType());
        $this->assertEquals("fabric", $facet->getValue());
    }

    public function testSetters(): void
    {
        $facet = new Facet(FacetType::CATEGORIES, "fabric");

        $facet->setType(FacetType::VERSIONS);
        $facet->setValue("1.20.1");

        $this->assertEquals(FacetType::VERSIONS, $facet->getType());
        $this->assertEquals("1.20.1", $facet->getValue());
        $this->assertEquals("versions = 1.20.1", $facet->serialize());
    }

    public function testSerializeUsesEqualsByDefault(): void
    {
        $this->assertEquals(
            "project_type = mod",
            (new Facet(FacetType::PROJECT_TYPE, "mod"))->serialize()
        );
    }

    /**
     * @return array<string, array{0: FacetOperation, 1: string}>
     */
    public static function operationProvider(): array
    {
        return [
            "equals" => [FacetOperation::EQUALS, "downloads = 100"],
            "not equals" => [FacetOperation::NOT_EQUALS, "downloads != 100"],
            "greater than" => [FacetOperation::GREATER_THAN, "downloads > 100"],
            "greater than or equals" => [FacetOperation::GREATER_THAN_OR_EQUALS, "downloads >= 100"],
            "less than" => [FacetOperation::LESS_THAN, "downloads < 100"],
            "less than or equals" => [FacetOperation::LESS_THAN_OR_EQUALS, "downloads <= 100"],
        ];
    }

    #[DataProvider("operationProvider")]
    public function testSerializeWithOperation(FacetOperation $operation, string $expected): void
    {
        $facet = new Facet(FacetType::DOWNLOADS, "100", $operation);
        $this->assertEquals($expected, $facet->serialize());
    }
}
