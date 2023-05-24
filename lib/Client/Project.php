<?php

namespace Aternos\ModrinthApi\Client;

class Project
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected \Aternos\ModrinthApi\Model\Project $data
    )
    {
    }

    /**
     * @return \Aternos\ModrinthApi\Model\Project
     */
    public function getData(): \Aternos\ModrinthApi\Model\Project
    {
        return $this->data;
    }
}