<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\ApiException;
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

    /**
     * Fetch all members of the team this member belongs to from the API
     * @return TeamMember[]
     * @throws ApiException
     */
    public function getTeamMembers(): array
    {
        return $this->client->getTeamMembers($this->getTeamId());
    }
}
