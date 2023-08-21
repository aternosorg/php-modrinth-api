<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Notification;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{

    public function testGetDataReturnsCorrectNotificationModel(): void
    {
        $notificationModel = $this->getExampleNotificationModel();
        $notification = new Notification(new ModrinthAPIClient(), $notificationModel);
        $this->assertEquals($notificationModel, $notification->getData());
    }

    public function testGetUserReturnsCorrectUser(): void
    {
        // Here we must mock the client, because it requests the user from the API to get all details
        $handler = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/get_user_response.json")),
            new Response(200, [], file_get_contents(__DIR__ . "/../Fixtures/get_user_response.json"))
        ]);
        $client = new ModrinthAPIClient(null, null, new Client(['handler' => HandlerStack::create($handler)]));

        $notification = new Notification($client, $this->getExampleNotificationModel());
        // Dc7EYhxG -> https://modrinth.com/user/Prospector
        $user = $client->getUser("Dc7EYhxG");
        $this->assertEquals($user, $notification->getUser());
    }

    protected function getExampleNotificationModel(): \Aternos\ModrinthApi\Model\Notification
    {
        $json = json_decode(file_get_contents(__DIR__ . "/../Fixtures/get_notification_response.json"), true);
        return new \Aternos\ModrinthApi\Model\Notification($json);
    }
}