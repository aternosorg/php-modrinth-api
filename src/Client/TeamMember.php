<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\TeamMember as TeamMemberModel;

class TeamMember extends TeamMemberModel
{
    public function __construct(
        protected ModrinthAPIClient $client,
        TeamMemberModel   $data,
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Get the user object of the team member
     * @return User
     */
    public function getUser(): User
    {
        return new User($this->client, parent::getUser());
    }
}
