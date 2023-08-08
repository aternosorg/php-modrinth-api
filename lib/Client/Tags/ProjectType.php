<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;

class ProjectType
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        protected string $data,
    )
    {
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Convert this loader to a facet to use it in a search
     * @return Facet
     */
    public function toFacet(): Facet
    {
        return new Facet(FacetType::PROJECT_TYPE, $this->data);
    }

    function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}