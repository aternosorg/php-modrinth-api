<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\ProjectResult;

/**
 * Class SearchProject
 *
 * @description A project as a result of a search
 * @package Aternos\ModrinthApi\Client
 */
class SearchProject extends ProjectResult
{
    use ProjectTrait;

    public function __construct(
        protected ModrinthAPIClient $client,
        ProjectResult $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Fetch the full project from the API
     * @return Project
     * @throws ApiException
     */
    public function getFullProject(): Project
    {
        return $this->client->getProject($this->getProjectId());
    }

    /**
     * Fetch the author of this project from the API.
     *
     * Named differently from the inherited {@link ProjectResult::getAuthor()}, which
     * returns the author's username without requesting anything.
     *
     * Returns null if the search result has no author id. The author is always a user,
     * even for projects owned by an organization, which are identified separately by
     * {@link ProjectResult::getOrganizationId()}.
     *
     * @return User|null
     * @throws ApiException
     */
    public function fetchAuthor(): ?User
    {
        if ($this->getAuthorId() === null) {
            return null;
        }

        return $this->client->getUser($this->getAuthorId());
    }

    protected function getId(): string
    {
        return $this->getProjectId();
    }

    protected function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
