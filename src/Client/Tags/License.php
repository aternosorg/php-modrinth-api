<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\LicenseTag;

class License extends LicenseTag
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        LicenseTag $data,
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
        return new Facet(FacetType::LICENSE, $this->getShort());
    }

    function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
