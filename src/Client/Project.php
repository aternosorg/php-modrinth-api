<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\Threads\Thread;
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

    /**
     * Fetch the moderation thread of this project (requires authentication)
     * This sends a request to the Modrinth API every time it is called.
     *
     * Not part of {@link ProjectTrait} because search results do not carry a thread id.
     *
     * @return Thread
     * @throws ApiException
     */
    public function fetchThread(): Thread
    {
        return $this->client->getThread($this->getThreadId());
    }

    protected function getClient(): ModrinthAPIClient
    {
        return $this->client;
    }
}
