<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\Project as ProjectModel;

class Project
{
    use ProjectTrait;

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

    protected function getId(): string
    {
        return $this->data->getId();
    }

    protected function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}