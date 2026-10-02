<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Threads;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Threads\Thread;
use Aternos\ModrinthApi\Client\Threads\ThreadMessage;
use Aternos\ModrinthApi\Model\Thread as ThreadModel;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;
use GuzzleHttp\Psr7\Response;

class ThreadMessageTest extends ClientTestCase
{
    protected function getExampleThread(ModrinthAPIClient $client): Thread
    {
        return new Thread($client, $this->fixtureModel("get_thread_response", ThreadModel::class));
    }

    public function testConstructorCopiesTheModelData(): void
    {
        $client = $this->createClient();
        $thread = $this->getExampleThread($client);
        $message = $thread->getMessages()[0];

        $this->assertInstanceOf(ThreadMessage::class, $message);
        $this->assertEquals("MsG00001", $message->getId());
        $this->assertEquals("b1AIbOxO", $message->getAuthorId());
        $this->assertEquals("Could you explain what this project does?", $message->getBody()->getBody());
    }

    public function testGetThread(): void
    {
        $client = $this->createClient();
        $thread = $this->getExampleThread($client);

        $this->assertSame($thread, $thread->getMessages()[0]->getThread());
    }

    public function testReply(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);
        $message = $this->getExampleThread($client)->getMessages()[0];

        $updated = $message->reply("Sure, it does X.");

        $this->assertInstanceOf(Thread::class, $updated);
        $this->assertRequest("POST", "/v2/thread/Ba1AaBbC");
        $this->assertRequestAuthenticated();
        $this->assertEquals([
            "type" => "text",
            "body" => "Sure, it does X.",
        ], json_decode((string)$this->getRequest()->getBody(), true));
    }

    public function testReplyPrivately(): void
    {
        $client = $this->createAuthenticatedClient([$this->fixtureResponse("get_thread_response")]);
        $message = $this->getExampleThread($client)->getMessages()[0];

        $message->reply("Internal note", true);

        $this->assertEquals([
            "type" => "text",
            "body" => "Internal note",
            "private" => true,
        ], json_decode((string)$this->getRequest()->getBody(), true));
    }

    public function testDelete(): void
    {
        $client = $this->createAuthenticatedClient([new Response(204)]);
        $message = $this->getExampleThread($client)->getMessages()[1];

        $message->delete();

        $this->assertRequest("DELETE", "/v2/message/MsG00002");
        $this->assertRequestAuthenticated();
    }
}
