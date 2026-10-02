<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\Notification as NotificationModel;

class Notification
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected NotificationModel $data,
    )
    {
    }

    /**
     * @return NotificationModel
     */
    public function getData(): NotificationModel
    {
        return $this->data;
    }

    /**
     * Get the user that received the notification
     * @return User
     * @throws ApiException
     */
    public function getUser(): User
    {
        return $this->client->getUser($this->data->getUserId());
    }
}