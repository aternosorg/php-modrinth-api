<?php

namespace Aternos\ModrinthApi\Client;

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
}