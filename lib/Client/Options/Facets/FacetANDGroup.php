<?php

namespace Aternos\ModrinthApi\Client\Options\Facets;

/**
 * Class FacetANDGroup
 *
 * @description A group of FacetORGroups where all groups must match.
 * @package Aternos\ModrinthApi\Client\Options\Facets
 */
class FacetANDGroup
{
    /**
     * @var FacetORGroup[]
     */
    protected array $orGroups;

    /**
     * @param FacetORGroup[]|Facet[][]|Facet[] $orGroups
     */
    public function __construct(array $orGroups = [])
    {
        $this->orGroups = array_map(function ($x) {
            if ($x instanceof FacetORGroup) {
                return $x;
            }

            if ($x instanceof Facet) {
                return new FacetORGroup([$x]);
            }

            if (!is_array($x)) {
                throw new \InvalidArgumentException("FacetANDGroup can only be constructed from FacetORGroup[], Facet[][] or Facet[]");
            }

            if (!array_reduce($x, function ($carry, $item) {
                return $carry && $item instanceof Facet;
            }, true)) {
                throw new \InvalidArgumentException("FacetANDGroup can only be constructed from FacetORGroup[], Facet[][] or Facet[]");
            }

            return new FacetORGroup($x);
        }, $orGroups);
    }

    /**
     * @return FacetORGroup[]
     */
    public function getORGroups(): array
    {
        return $this->orGroups;
    }

    /**
     * @param FacetORGroup[] $orGroups
     * @return $this
     */
    public function setORGroups(array $orGroups): self
    {
        $this->orGroups = $orGroups;
        return $this;
    }

    /**
     * @param FacetORGroup $facet
     * @return $this
     */
    public function addORGroup(FacetORGroup $facet): self
    {
        $this->orGroups[] = $facet;
        return $this;
    }

    /**
     * @param FacetORGroup ...$groups
     * @return $this
     */
    public function addORGroups(FacetORGroup ...$groups): self
    {
        foreach ($groups as $group) {
            $this->orGroups[] = $group;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return json_encode(array_map(function (FacetORGroup $group) {
            return $group->serialize();
        }, $this->orGroups));
    }
}