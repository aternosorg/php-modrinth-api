<?php

namespace Aternos\ModrinthApi\Client\Options\Facets;

/**
 * Class Facet
 *
 * @description A facet to filter projects by.
 * @package Aternos\ModrinthApi\Client\Options\Facets
 */
class Facet
{
    /**
     * @param FacetType $type
     * @param string $value
     */
    public function __construct(
        protected FacetType $type,
        protected string $value,
    )
    {
    }

    /**
     * @return FacetType
     */
    public function getType(): FacetType
    {
        return $this->type;
    }

    /**
     * @param FacetType $type
     */
    public function setType(FacetType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function serialize(): string
    {
        return $this->type->value . ":" . $this->value;
    }
}