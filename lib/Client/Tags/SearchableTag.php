<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;

trait SearchableTag
{
    /**
     * Get the api client
     * @return ModrinthAPIClient
     */
    abstract function getClient(): ModrinthAPIClient;

    /**
     * Convert this tag to a facet to use it in a search
     * @return Facet
     */
    abstract function toFacet(): Facet;

    /**
     * Search projects with this tag
     * @param ProjectSearchOptions $options
     * @return PaginatedProjectSearchList
     * @throws ApiException
     */
    public function searchProjects(ProjectSearchOptions $options = new ProjectSearchOptions()): PaginatedProjectSearchList
    {
        $facets = $options->getFacets();
        $facets->addORGroup($this->toFacet());
        $options->setFacets($facets);
        return $this->getClient()->searchProjects($options);
    }
}