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
     * Fetch the user that received the notification
     * This sends a request to the Modrinth API every time it is called.
     * @return User
     * @throws ApiException
     */
    public function fetchUser(): User
    {
        return $this->client->getUser($this->getUserId());
    }
}
