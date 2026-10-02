<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\Facets\Facet;
use Aternos\ModrinthApi\Client\Options\Facets\FacetType;
use Aternos\ModrinthApi\Model\GameVersionTag;

class GameVersion extends GameVersionTag
{
    use SearchableTag;

    public function __construct(
        protected ModrinthAPIClient $client,
        GameVersionTag $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Convert this game version to a facet to use it in a search
     * @return Facet
     */
    public function toFacet(): Facet
    {
        return new Facet(FacetType::VERSIONS, $this->getVersion());
    }

    function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
