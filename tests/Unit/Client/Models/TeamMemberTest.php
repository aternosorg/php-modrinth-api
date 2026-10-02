<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\TeamMember;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Model\TeamMember as TeamMemberModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;

class TeamMemberTest extends ClientTestCase
{
    protected function getExampleTeamMemberModel(): TeamMemberModel
    {
        return $this->fixtureModel("get_team_members_response", TeamMemberModel::class . "[]")[0];
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $model = $this->getExampleTeamMemberModel();
        $member = new TeamMember($this->createClient(), $model);

        $this->assertEquals($model->getTeamId(), $member->getTeamId());
        $this->assertEquals($model->getRole(), $member->getRole());
        $this->assertEquals($model->getPermissions(), $member->getPermissions());
    }

    public function testGetUserReturnsAClientUserWithoutRequest(): void
    {
        $client = $this->createClient();
        $member = new TeamMember($client, $this->getExampleTeamMemberModel());

        $user = $member->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals("Dc7EYhxG", $user->getId());
        $this->assertEquals("Prospector", $user->getUsername());
        $this->assertRequestCount(0);
    }

    public function testGetUserCanRequestTheUsersProjects(): void
    {
        $client = $this->createClient([
            $this->jsonResponse([$this->fixtureData("get_project_response")]),
        ]);
        $member = new TeamMember($client, $this->getExampleTeamMemberModel());

        $this->assertCount(1, $member->getUser()->getProjects());
        $this->assertRequest("GET", "/v2/user/Dc7EYhxG/projects");
    }
}
