<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Model\TeamMember as TeamMemberModel;

class TeamMember
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected TeamMemberModel   $data,
    )
    {
    }

    /**
     * @return TeamMemberModel
     */
    public function getData(): TeamMemberModel
    {
        return $this->data;
    }

    /**
     * Get the user object of the team member
     * @return User
     */
    public function getUser(): User
    {
        return new User($this->client, $this->data->getUser());
    }
}