<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\Project as ProjectModel;

class Project extends ProjectModel
{
    use ProjectTrait;

    public function __construct(
        protected ModrinthAPIClient $client,
        ProjectModel $data
    )
    {
        parent::__construct($data->container);
    }

    protected function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
