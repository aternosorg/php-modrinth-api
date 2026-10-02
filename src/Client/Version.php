<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\Version as VersionModel;
use Aternos\ModrinthApi\Model\VersionDependency as VersionDependencyModel;

class Version extends VersionModel
{
    public function __construct(
        protected ModrinthAPIClient $client,
        VersionModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Fetch the full project from the API
     * @return Project
     * @throws ApiException
     */
    public function getProject(): Project
    {
        return $this->client->getProject($this->getProjectId());
    }

    /**
     * Fetch the user that published this version from the API
     * @return User
     * @throws ApiException
     */
    public function getAuthor(): User
    {
        return $this->client->getUser($this->getAuthorId());
    }


    /**
     * Get the dependencies of this version
     * @return VersionDependency[]
     */
    public function getDependencies(): array
    {
        return array_map(function (VersionDependencyModel $dependency) {
            return new VersionDependency($this->client, $dependency);
        }, parent::getDependencies() ?? []);
    }
}
