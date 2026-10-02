<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\Notification;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Model\User as UserModel;
use Aternos\ModrinthApi\Model\UserPayoutHistory;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;

class UserTest extends ClientTestCase
{
    protected function getExampleUserModel(): UserModel
    {
        return $this->fixtureModel("get_user_response", UserModel::class);
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $model = $this->getExampleUserModel();
        $user = new User($this->createClient(), $model);

        $this->assertEquals($model->getId(), $user->getId());
        $this->assertEquals($model->getUsername(), $user->getUsername());
    }

    public function testGetProjects(): void
    {
        $client = $this->createClient([
            $this->jsonResponse([$this->fixtureData("get_project_response")]),
        ]);
        $user = new User($client, $this->getExampleUserModel());

        $projects = $user->getProjects();
        $this->assertCount(1, $projects);
        $this->assertInstanceOf(Project::class, $projects[0]);
        $this->assertRequest("GET", "/v2/user/Dc7EYhxG/projects");
    }

    public function testGetNotifications(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_notification_response")]),
        ]);
        $user = new User($client, $this->getExampleUserModel());

        $notifications = $user->getNotifications();
        $this->assertCount(1, $notifications);
        $this->assertInstanceOf(Notification::class, $notifications[0]);
        $this->assertRequest("GET", "/v2/user/Dc7EYhxG/notifications");
        $this->assertRequestAuthenticated();
    }

    public function testGetFollowedProjects(): void
    {
        $client = $this->createAuthenticatedClient([
            $this->jsonResponse([$this->fixtureData("get_project_response")]),
        ]);
        $user = new User($client, $this->getExampleUserModel());

        $projects = $user->getFollowedProjects();
        $this->assertCount(1, $projects);
        $this->assertInstanceOf(Project::class, $projects[0]);
        $this->assertRequest("GET", "/v2/user/Dc7EYhxG/follows");
        $this->assertRequestAuthenticated();
    }

    public function testGetPayoutHistory(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_payout_history_response")]);
        $user = new User($client, $this->getExampleUserModel());

        $history = $user->getPayoutHistory();
        $this->assertInstanceOf(UserPayoutHistory::class, $history);
        $this->assertEquals("78.90", $history->getLastMonth());
        $this->assertRequest("GET", "/v2/user/Dc7EYhxG/payouts");
        $this->assertRequestAuthenticated();
    }
}
