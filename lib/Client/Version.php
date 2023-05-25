<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
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

    /**
     * Fetch the full project from the API
     * @return Project
     * @throws ApiException
     */
    public function getProject(): Project
    {
        return $this->client->getProject($this->data->getProjectId());
    }
}