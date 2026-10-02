<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Model\Notification as NotificationModel;

class Notification extends NotificationModel
{
    public function __construct(
        protected ModrinthAPIClient $client,
        NotificationModel $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Get the user that received the notification
     * @return User
     * @throws ApiException
     */
    public function getUser(): User
    {
        return $this->client->getUser($this->getUserId());
    }
}
