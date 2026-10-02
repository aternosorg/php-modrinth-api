<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\LoaderTag;

class Loader extends LoaderTag
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        LoaderTag $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Convert this loader to a facet to use it in a search
     * @return Facet
     */
    public function toFacet(): Facet
    {
        return new Facet(FacetType::CATEGORIES, $this->getName());
    }

    function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
