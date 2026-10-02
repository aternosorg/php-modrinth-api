<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\VersionDependency as VersionDependencyModel;

class VersionDependency extends VersionDependencyModel
{
    public function __construct(
        protected ModrinthAPIClient      $client,
        VersionDependencyModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Get the project of this dependency (if available)
     * @return Project|null
     * @throws ApiException
     */
    public function getProject(): ?Project
    {
        if ($this->getProjectId() === null) {
            return null;
        }

        return $this->client->getProject($this->getProjectId());
    }

    /**
     * Get the version of this dependency (if available)
     * @return Version|null
     * @throws ApiException
     */
    public function getVersion(): ?Version
    {
        if ($this->getVersionId() === null) {
            return null;
        }

        return $this->client->getVersion($this->getVersionId());
    }
}
