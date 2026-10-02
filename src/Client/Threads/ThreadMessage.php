<?php

namespace Aternos\ModrinthApi\Client\Threads;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Model\ThreadMessage as ThreadMessageModel;


class ThreadMessage extends ThreadMessageModel
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected Thread $thread,
        ThreadMessageModel $threadMessage,
    )
    {
        parent::__construct($threadMessage->container);
    }

    /**
     * @return Thread
     */
    public function getThread(): Thread
    {
        return $this->thread;
    }

    /**
     * Fetch the user that wrote this message from the API.
     * Returns null if the message has no author, e.g. for system messages.
     * @return User|null
     * @throws ApiException
     */
    public function getAuthor(): ?User
    {
        if ($this->getAuthorId() === null) {
            return null;
        }

        return $this->client->getUser($this->getAuthorId());
    }

    /**
     * Reply to the thread
     * @param string $body
     * @param bool|null $private
     * @return Thread
     * @throws ApiException
     */
    public function reply(string $body, ?bool $private = null): Thread
    {
        return $this->thread->sendMessage(ThreadMessageType::TEXT, $body, $private);
    }

    /**
     * Delete this message
     * @return void
     * @throws ApiException
     */
    public function delete(): void
    {
        $this->thread->deleteMessage($this->getId());
    }
}
