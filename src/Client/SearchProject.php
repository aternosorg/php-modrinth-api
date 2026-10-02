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

    protected function getId(): string
    {
        return $this->getProjectId();
    }

    protected function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
