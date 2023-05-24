<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\Version as VersionModel;

class Version
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected VersionModel $data
    )
    {
    }

    /**
     * @return VersionModel
     */
    public function getData(): VersionModel
    {
        return $this->data;
    }
}