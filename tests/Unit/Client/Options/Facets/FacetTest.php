<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Options\Facets;

use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetOperation;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\DisclosureTypeEnum;
use Aternos\ModrinthApi\Model\EnvironmentEnum;
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

    /**
     * Every case of the enum, so that a newly added facet type is covered automatically
     * @return array<string, array{0: FacetType}>
     */
    public static function facetTypeProvider(): array
    {
        $cases = [];
        foreach (FacetType::cases() as $case) {
            $cases[$case->name] = [$case];
        }
        return $cases;
    }

    #[DataProvider("facetTypeProvider")]
    public function testEveryFacetTypeSerializes(FacetType $type): void
    {
        $this->assertEquals($type->value . " = x", (new Facet($type, "x"))->serialize());
    }

    /**
     * Pins the wire value of every facet type. Deliberately written out instead of
     * derived from the enum, so that renaming a case or changing its value has to be
     * done here too and cannot happen by accident.
     */
    public function testFacetTypeValues(): void
    {
        $expected = [
            "PROJECT_TYPE" => "project_type",
            "CATEGORIES" => "categories",
            "VERSIONS" => "versions",
            "OPEN_SOURCE" => "open_source",
            "ENVIRONMENT" => "environment",
            "ALL_PROJECT_TYPES" => "all_project_types",
            "DISCLOSURE_TYPES" => "disclosure_types",
            "TITLE" => "title",
            "AUTHOR" => "author",
            "FOLLOWS" => "follows",
            "PROJECT_ID" => "project_id",
            "LICENSE" => "license",
            "DOWNLOADS" => "downloads",
            "COLOR" => "color",
            "CREATED_TIMESTAMP" => "created_timestamp",
            "MODIFIED_TIMESTAMP" => "modified_timestamp",
        ];

        $actual = [];
        foreach (FacetType::cases() as $case) {
            $actual[$case->name] = $case->value;
        }

        $this->assertEquals($expected, $actual);
    }

    public function testEnvironmentFacetFromGeneratedEnum(): void
    {
        $facet = new Facet(FacetType::ENVIRONMENT, EnvironmentEnum::SERVER_ONLY->value);
        $this->assertEquals("environment = server_only", $facet->serialize());
    }

    public function testDisclosureTypeFacetFromGeneratedEnum(): void
    {
        $facet = new Facet(FacetType::DISCLOSURE_TYPES, DisclosureTypeEnum::AI_CONTENT->value);
        $this->assertEquals("disclosure_types = ai_content", $facet->serialize());
    }

}
