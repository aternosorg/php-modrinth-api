<?php

namespace Aternos\ModrinthApi\Client\Options;

use Aternos\ModrinthApi\Client\Options\Facets\FacetANDGroup;
use Aternos\ModrinthApi\Client\Options\Facets\FacetORGroup;

/**
 * Class ProjectSearchOptions
 *
 * @description This class represents the options for a project search.
 * @package Aternos\ModrinthApi\Client\Options
 */
class ProjectSearchOptions
{
    protected ?FacetANDGroup $facets = null;

    /**
     * @param string|null $query The query to search for.
     * @param FacetANDGroup|FacetORGroup|null $facets The recommended way of filtering search results.
     * @param SearchIndex $index The sorting method used for sorting search results.
     * @param string|null $filters A list of filters relating to the properties of a project. Use filters when there isn't an available facet for your needs.
     * @param int $offset The offset into the search. Skips this number of results.
     * @param int $limit The number of results returned by the search.
     */
    public function __construct(
        protected ?string $query = null,
        FacetANDGroup|FacetORGroup|null $facets = null,
        protected SearchIndex $index = SearchIndex::RELEVANCE,
        protected ?string $filters = null,
        protected int $offset = 0,
        protected int $limit = 50,
    )
    {
        if ($facets instanceof FacetORGroup) {
            $facets = $facets->toANDGroup();
        }
        $this->facets = $facets;
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param string|null $query
     * @return $this
     */
    public function setQuery(?string $query): static
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return FacetANDGroup|null
     */
    public function getFacets(): ?FacetANDGroup
    {
        return $this->facets;
    }

    /**
     * @param FacetANDGroup|null $facets
     * @return $this
     */
    public function setFacets(?FacetANDGroup $facets): static
    {
        $this->facets = $facets;
        return $this;
    }

    /**
     * @return SearchIndex
     */
    public function getIndex(): SearchIndex
    {
        return $this->index;
    }

    /**
     * @param SearchIndex $index
     * @return $this
     */
    public function setIndex(SearchIndex $index): static
    {
        $this->index = $index;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilters(): ?string
    {
        return $this->filters;
    }

    /**
     * @param string|null $filters
     * @return $this
     */
    public function setFilters(?string $filters): static
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset(int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit): static
    {
        $this->limit = $limit;
        return $this;
    }
}