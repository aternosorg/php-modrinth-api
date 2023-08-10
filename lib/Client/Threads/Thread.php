<?php

namespace Aternos\ModrinthApi\Client\Threads;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Model\Thread as ThreadModel;

class Thread
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected ThreadModel $thread,
    )
    {
    }

    /**
     * @return ThreadModel
     */
    public function getData(): ThreadModel
    {
        return $this->thread;
    }

    /**
     * Fetch the full project from the API if the thread has a project id
     * @return Project|null
     * @throws ApiException
     */
    public function getProject(): ?Project
    {
        if ($id = $this->thread->getProjectId()) {
            return $this->client->getProject($id);
        }

        return null;
    }

    /**
     * Fetch the full report from the API if the thread has a report id
     * @return Report|null
     * @throws ApiException
     */
    public function getReport(): ?Report
    {
        if ($id = $this->thread->getReportId()) {
            return $this->client->getReport($id);
        }

        return null;
    }

    /**
     * Get all messages of the thread
     * @return ThreadMessage[]
     */
    public function getMessages(): array
    {
        return array_map(function ($message) {
            return new ThreadMessage($this->client, $this, $message);
        }, $this->thread->getMessages());
    }

    /**
     * Get all members of the thread
     * @return User[]
     */
    public function getMembers(): array
    {
        return array_map(function ($member) {
            return new User($this->client, $member);
        }, $this->thread->getMembers());
    }

    /**
     * Send a message to the thread (requires authentication)
     * @param ThreadMessageType $messageType
     * @param string|null $body
     * @param bool|null $private
     * @param string|null $replyingTo
     * @param string|null $oldStatus
     * @param string|null $newStatus
     * @return Thread
     * @throws ApiException
     */
    public function sendMessage(
        ThreadMessageType $messageType,
        ?string           $body = null,
        ?bool             $private = null,
        ?string           $replyingTo = null,
        ?string           $oldStatus = null,
        ?string           $newStatus = null,
    ): Thread
    {
        return $this->client->sendThreadMessage(
            $this->thread->getId(),
            $messageType,
            $body,
            $private,
            $replyingTo,
            $oldStatus,
            $newStatus,
        );
    }

    /**
     * Delete a message from the thread (requires authentication)
     * @param string $messageId
     * @return void
     * @throws ApiException
     */
    public function deleteMessage(string $messageId): void
    {
        $this->client->deleteThreadMessage($this->thread->getId(), $messageId);
    }
}