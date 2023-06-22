<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\LoaderTag;

class Loader
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        protected LoaderTag $data,
    )
    {
    }

    /**
     * @return LoaderTag
     */
    public function getData(): LoaderTag
    {
        return $this->data;
    }

    /**
     * Convert this loader to a facet to use it in a search
     * @return Facet
     */
    public function toFacet(): Facet
    {
        return new Facet(FacetType::CATEGORIES, $this->data->getName());
    }

    function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}