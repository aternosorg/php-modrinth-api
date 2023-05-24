<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Api\ProjectsApi;
use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\Model\CheckProjectValidity200Response as ProjectValidity;
use Aternos\ModrinthApi\Model\Project as ProjectModel;
use Aternos\ModrinthApi\Model\ProjectDependencyList;

/**
 * Class ModrinthAPIClient
 *
 * @description This class is the main entry point for the Modrinth API client.
 * @package Aternos\ModrinthApi\Client
 */
class ModrinthAPIClient
{
    protected Configuration $configuration;

    protected ?string $apiToken = null;

    protected ProjectsApi $projects;

    /**
     * ModrinthAPIClient constructor.
     * @param string|null $apiToken API token used for authentication
     * @param Configuration|null $configuration
     */
    public function __construct(?string $apiToken = null, ?Configuration $configuration = null)
    {
        $this->configuration = $configuration ?? (Configuration::getDefaultConfiguration())
            ->setUserAgent("php-modrinth-api/1.0.0");
        $this->setApiToken($apiToken);
    }

    /**
     * @param Configuration $configuration
     * @return $this
     */
    public function setConfiguration(Configuration $configuration): static
    {
        $this->configuration = $configuration;

        $this->projects = new ProjectsApi(null, $this->configuration);
        return $this;
    }

    /**
     * Set the user agent used for HTTP requests
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent): static
    {
        $this->configuration->setUserAgent($userAgent);
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Set the API token used for authentication.
     * @param string|null $token
     * @return $this
     */
    public function setApiToken(?string $token): static
    {
        $this->apiToken = $token;
        $this->configuration->setApiKey("Authorization", $token);
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Search projects
     * @param ProjectSearchOptions|null $options
     * @return PaginatedProjectSearchList
     * @throws ApiException
     */
    public function searchProjects(?ProjectSearchOptions $options = null): PaginatedProjectSearchList
    {
        $options = $options ?? new ProjectSearchOptions();
        $projects = $this->projects->searchProjects(
            $options->getQuery(),
            $options->getFacets(),
            $options->getIndex(),
            $options->getOffset(),
            $options->getLimit(),
            $options->getFilters(),
        );

        return new PaginatedProjectSearchList($this, $options, $projects);
    }

    /**
     * Get a project by ID or slug
     * @param string $idOrSlug Project ID or slug
     * @return Project
     * @throws ApiException
     */
    public function getProject(string $idOrSlug): Project
    {
        return new Project($this, $this->projects->getProject($idOrSlug));
    }

    /**
     * Get multiple projects by ID
     * @param string[] $ids
     * @return Project[]
     * @throws ApiException
     */
    public function getProjects(array $ids): array
    {
        return array_map(function (ProjectModel $project): Project {
            return new Project($this, $project);
        }, $this->projects->getProjects($ids));
    }

    /**
     * Get a list of random projects
     * @param int $count
     * @return Project[]
     * @throws ApiException
     */
    public function getRandomProjects(int $count): array
    {
        return array_map(function (ProjectModel $project): Project {
            return new Project($this, $project);
        }, $this->projects->randomProjects($count));
    }

    /**
     * Check if a project or
     * @param string $idOrSlug slug or id to check
     * @return string|null Project ID if the project is valid, null if not
     * @throws ApiException
     */
    public function checkProjectValidity(string $idOrSlug): ?string
    {
        try {
            return $this->projects->checkProjectValidity($idOrSlug)->getId();
        }
        catch (ApiException $exception) {
            if ($exception->getCode() === 404) {
                return null;
            }
            throw $exception;
        }
    }

    /**
     * Get a project's dependencies
     * @param string $idOrSlug
     * @return ProjectDependencies
     * @throws ApiException
     */
    public function getProjectDependencies(string $idOrSlug): ProjectDependencies
    {
        return new ProjectDependencies($this, $this->projects->getDependencies($idOrSlug));
    }
}