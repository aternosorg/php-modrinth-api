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
        protected array $facets = []
    )
    {
    }

    /**
     * @return Facet[]
     */
    public function getFacets(): array
    {
        return $this->facets;
    }

    /**
     * @param Facet[] $facets
     * @return $this
     */
    public function setFacets(array $facets): self
    {
        $this->facets = $facets;
        return $this;
    }

    /**
     * @param Facet $facet
     * @return $this
     */
    public function addFacet(Facet $facet): self
    {
        $this->facets[] = $facet;
        return $this;
    }

    /**
     * @param Facet[] $facets
     * @return $this
     */
    public function addFacets(Facet ...$facets): self
    {
        foreach ($facets as $facet) {
            $this->addFacet($facet);
        }
        return $this;
    }

    /**
     * Add multiple facets of one type (e.g. multiple Minecraft versions or loaders)
     * @param FacetType $type
     * @param string[] $values
     * @return $this
     */
    public function addMultiple(FacetType $type, ...$values): self
    {
        foreach ($values as $value) {
            $this->addFacet(new Facet($type, $value));
        }
        return $this;
    }

    /**
     * Convert this FacetORGroup directly to a FacetANDGroup
     * @return FacetANDGroup
     */
    public function toANDGroup(): FacetANDGroup
    {
        return new FacetANDGroup([$this]);
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