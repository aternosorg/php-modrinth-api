<?php

namespace Aternos\ModrinthApi\Client\Options\Facets;

/**
 * Class FacetORGroup
 *
 * @description A group of facets where only one must match.
 * @package Aternos\ModrinthApi\Client\Options\Facets
 */
class FacetORGroup
{
    /**
     * @param Facet[] $facets
     */
    public function __construct(
        protected array $facets
    )
    {
    }

    /**
     * @return array
     */
    public function getFacets(): array
    {
        return $this->facets;
    }

    /**
     * @param array $facets
     */
    public function setFacets(array $facets): void
    {
        $this->facets = $facets;
    }

    /**
     * @param Facet $facet
     */
    public function addFacet(Facet $facet): void
    {
        $this->facets[] = $facet;
    }

    /**
     * @return string[]
     */
    public function serialize(): array
    {
        return array_map(function (Facet $facet) {
            return $facet->serialize();
        }, $this->facets);
    }
}