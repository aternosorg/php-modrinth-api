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
     * Fetch the project of this dependency
     * This sends a request to the Modrinth API every time it is called.
     * Returns null if the dependency has no project id.
     * @return Project|null
     * @throws ApiException
     */
    public function fetchProject(): ?Project
    {
        if ($this->getProjectId() === null) {
            return null;
        }

        return $this->client->getProject($this->getProjectId());
    }

    /**
     * Fetch the version of this dependency
     * This sends a request to the Modrinth API every time it is called.
     * Returns null if the dependency has no version id.
     * @return Version|null
     * @throws ApiException
     */
    public function fetchVersion(): ?Version
    {
        if ($this->getVersionId() === null) {
            return null;
        }

        return $this->client->getVersion($this->getVersionId());
    }
}
