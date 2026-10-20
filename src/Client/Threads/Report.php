<?php

namespace Aternos\ModrinthApi\Client\Threads;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Model\Report as ReportModel;
use Exception;

class Report extends ReportModel
{
    public function __construct(
        protected ModrinthAPIClient $client,
        ReportModel $report,
    )
    {
        parent::__construct($report->container);
    }

    /**
     * @return ReportItemType
     */
    public function getItemTypeEnum(): ReportItemType
    {
        return ReportItemType::from($this->getItemType());
    }

    /**
     * Fetch the reported project if the report is a project report
     * This sends a request to the Modrinth API every time it is called.
     * @return Project
     * @throws ApiException
     * @throws Exception
     */
    public function fetchProject(): Project
    {
        if ($this->getItemTypeEnum() !== ReportItemType::PROJECT) {
            throw new Exception("Report is not a project report");
        }

        return $this->client->getProject($this->getItemId());
    }

    /**
     * Fetch the reported user if the report is a user report
     * This sends a request to the Modrinth API every time it is called.
     * @return User
     * @throws ApiException
     * @throws Exception
     */
    public function fetchUser(): User
    {
        if ($this->getItemTypeEnum() !== ReportItemType::USER) {
            throw new Exception("Report is not a user report");
        }

        return $this->client->getUser($this->getItemId());
    }

    /**
     * Fetch the reported version if the report is a version report
     * This sends a request to the Modrinth API every time it is called.
     * @return Version
     * @throws ApiException
     * @throws Exception
     */
    public function fetchVersion(): Version
    {
        if ($this->getItemTypeEnum() !== ReportItemType::VERSION) {
            throw new Exception("Report is not a version report");
        }

        return $this->client->getVersion($this->getItemId());
    }

    /**
     * Fetch the thread of this report (requires authentication)
     * This sends a request to the Modrinth API every time it is called.
     * @return Thread
     * @throws ApiException
     */
    public function fetchThread(): Thread
    {
        return $this->client->getThread($this->getThreadId());
    }

    /**
     * Modify the report
     * @param string|null $body
     * @param bool|null $closed
     * @return $this
     * @throws ApiException
     */
    public function modify(?string $body, ?bool $closed): static
    {
        $this->client->modifyReport($this->getId(), $body, $closed);
        return $this;
    }
}
