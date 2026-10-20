<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;

trait ProjectTrait
{
    /**
     * Get the project ID
     * @return string
     */
    abstract protected function getId(): string;

    /**
     * Get the Modrinth API client
     * @return ModrinthAPIClient
     */
    abstract protected function getClient(): ModrinthAPIClient;

    /**
     * Fetch all dependencies of this project
     * This sends a request to the Modrinth API every time it is called.
     * @return ProjectDependencies
     * @throws ApiException
     */
    public function fetchDependencies(): ProjectDependencies
    {
        return $this->getClient()->getProjectDependencies($this->getId());
    }

    /**
     * Fetch all versions of this project
     * This sends a request to the Modrinth API every time it is called.
     * @param string[]|null $loaders only show versions for any of these loaders
     * @param string[]|null $gameVersions
     * @param bool|null $featured
     * @param bool|null $include_changelog whether to include changelogs in the response. Currently defaults to true on modrinth side.
     * @return Version[]
     * @throws ApiException
     */
    public function fetchProjectVersions(
        ?array $loaders = null,
        ?array $gameVersions = null,
        ?bool  $featured = null,
        ?bool  $include_changelog = null,
    ): array
    {
        return $this->getClient()->getProjectVersions($this->getId(), $loaders, $gameVersions, $featured, $include_changelog);
    }

    /**
     * Fetch the members of this project
     * This sends a request to the Modrinth API every time it is called.
     * @return TeamMember[]
     * @throws ApiException
     */
    public function fetchMembers(): array
    {
        return $this->getClient()->getProjectMembers($this->getId());
    }
}
