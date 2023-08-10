<?php

namespace Aternos\ModrinthApi\Client\Threads;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Model\ThreadMessage as ThreadMessageModel;


class ThreadMessage
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected Thread $thread,
        protected ThreadMessageModel $threadMessage,
    )
    {
    }

    /**
     * @return ThreadMessageModel
     */
    public function getData(): ThreadMessageModel
    {
        return $this->threadMessage;
    }

    /**
     * @return Thread
     */
    public function getThread(): Thread
    {
        return $this->thread;
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
        $this->thread->deleteMessage($this->threadMessage->getId());
    }
}