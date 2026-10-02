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
     * Get all dependencies of this project
     * @return ProjectDependencies
     * @throws ApiException
     */
    public function getDependencies(): ProjectDependencies
    {
        return $this->getClient()->getProjectDependencies($this->getId());
    }

    /**
     * Get all versions of this project
     * @param string[]|null $loaders only show versions for any of these loaders
     * @param string[]|null $gameVersions
     * @param bool|null $featured
     * @param bool|null $include_changelog whether to include changelogs in the response. Currently defaults to true on modrinth side.
     * @return Version[]
     * @throws ApiException
     */
    public function getVersions(
        ?array $loaders = null,
        ?array $gameVersions = null,
        ?bool  $featured = null,
        ?bool  $include_changelog = null,
    ): array
    {
        return $this->getClient()->getProjectVersions($this->getId(), $loaders, $gameVersions, $featured, $include_changelog);
    }

    /**
     * Get the members of this project
     * @return TeamMember[]
     * @throws ApiException
     */
    public function getMembers(): array
    {
        return $this->getClient()->getProjectMembers($this->getId());
    }
}
