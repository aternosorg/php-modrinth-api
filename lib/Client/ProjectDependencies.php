<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\ProjectDependencyList;

/**
 * Class ProjectDependencies
 *
 * @description A list of project dependencies
 * @package Aternos\ModrinthApi\Client
 */
class ProjectDependencies
{
    /**
     * @var Project[]
     */
    protected array $projects = [];

    /**
     * @var Version[]
     */
    protected array $versions = [];

    /**
     * @param ModrinthAPIClient $client
     * @param ProjectDependencyList $data
     */
    public function __construct(ModrinthAPIClient $client, ProjectDependencyList $data)
    {
        foreach ($data->getProjects() as $project) {
            $this->projects[] = new Project($client, $project);
        }

        foreach ($data->getVersions() as $version) {
            $this->versions[] = new Version($client, $version);
        }
    }

    /**
     * @return Project[]
     */
    public function getProjects(): array
    {
        return $this->projects;
    }

    /**
     * @return Version[]
     */
    public function getVersions(): array
    {
        return $this->versions;
    }
}