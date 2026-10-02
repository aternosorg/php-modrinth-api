<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\CategoryTag;

class Category extends CategoryTag
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        CategoryTag $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Convert this category to a facet to use it in a search
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
