<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\User as UserModel;
use Aternos\ModrinthApi\Model\UserPayoutHistory;

class User extends UserModel
{
    public function __construct(
        protected ModrinthAPIClient $client,
        UserModel         $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Fetch the user's projects
     * This sends a request to the Modrinth API every time it is called.
     * @return Project[]
     * @throws ApiException
     */
    public function fetchProjects(): array
    {
        return $this->client->getUserProjects($this->getId());
    }

    /**
     * Fetch the user's notifications (requires authentication)
     * This sends a request to the Modrinth API every time it is called.
     * @return Notification[]
     * @throws ApiException
     */
    public function fetchNotifications(): array
    {
        return $this->client->getUserNotifications($this->getId());
    }

    /**
     * Fetch the projects this user follows (requires authentication)
     * This sends a request to the Modrinth API every time it is called.
     * @return Project[]
     * @throws ApiException
     */
    public function fetchFollowedProjects(): array
    {
        return $this->client->getFollowedProjects($this->getId());
    }

    /**
     * Fetch the user's payout history (requires authentication)
     * This sends a request to the Modrinth API every time it is called.
     * @return UserPayoutHistory
     * @throws ApiException
     */
    public function fetchPayoutHistory(): UserPayoutHistory
    {
        return $this->client->getPayoutHistory($this->getId());
    }
}
