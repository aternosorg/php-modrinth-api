<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\Project as ProjectModel;

class Project
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected ProjectModel $data
    )
    {
    }

    /**
     * @return ProjectModel
     */
    public function getData(): ProjectModel
    {
        return $this->data;
    }
}