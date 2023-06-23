<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\LicenseTag;

class License
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        protected LicenseTag $data,
    )
    {
    }

    /**
     * @return LicenseTag
     */
    public function getData(): LicenseTag
    {
        return $this->data;
    }

    /**
     * Convert this loader to a facet to use it in a search
     * @return Facet
     */
    public function toFacet(): Facet
    {
        return new Facet(FacetType::LICENSE, $this->data->getShort());
    }

    function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}