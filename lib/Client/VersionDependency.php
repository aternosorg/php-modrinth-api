<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\VersionDependency as VersionDependencyModel;

class VersionDependency
{
    public function __construct(
        protected ModrinthAPIClient      $client,
        protected VersionDependencyModel $data
    )
    {
    }

    /**
     * @return VersionDependencyModel
     */
    public function getData(): VersionDependencyModel
    {
        return $this->data;
    }

    /**
     * Get the project of this dependency (if available)
     * @return Project|null
     * @throws ApiException
     */
    public function getProject(): ?Project
    {
        if ($this->data->getProjectId() === null) {
            return null;
        }

        return $this->client->getProject($this->data->getProjectId());
    }

    /**
     * Get the version of this dependency (if available)
     * @return Version|null
     * @throws ApiException
     */
    public function getVersion(): ?Version
    {
        if ($this->data->getVersionId() === null) {
            return null;
        }

        return $this->client->getVersion($this->data->getVersionId());
    }
}