<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\User as UserModel;
use Aternos\ModrinthApi\Model\UserPayoutHistory;

class User
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected UserModel         $data,
    )
    {
    }

    /**
     * @return UserModel
     */
    public function getData(): UserModel
    {
        return $this->data;
    }

    /**
     * Get the user's projects
     * @return Project[]
     * @throws ApiException
     */
    public function getProjects(): array
    {
        return $this->client->getUserProjects($this->data->getId());
    }

    /**
     * Get the user's notifications (requires authentication)
     * @return Notification[]
     * @throws ApiException
     */
    public function getNotifications(): array
    {
        return $this->client->getUserNotifications($this->data->getId());
    }

    /**
     * Get the user projects this user follows (requires authentication)
     * @return Project[]
     * @throws ApiException
     */
    public function getFollowedProjects(): array
    {
        return $this->client->getFollowedProjects($this->data->getId());
    }

    /**
     * Get the user's payout history (requires authentication)
     * @return UserPayoutHistory
     * @throws ApiException
     */
    public function getPayoutHistory(): UserPayoutHistory
    {
        return $this->client->getPayoutHistory($this->data->getId());
    }
}