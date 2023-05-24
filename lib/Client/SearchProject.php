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
class SearchProject
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected ProjectResult $data,
    )
    {
    }

    /**
     * @return ProjectResult
     */
    public function getData(): ProjectResult
    {
        return $this->data;
    }

    /**
     * Fetch the full project from the API
     * @return Project
     * @throws ApiException
     */
    public function getFullProject(): Project
    {
        return $this->client->getProject($this->data->getProjectId());
    }
}