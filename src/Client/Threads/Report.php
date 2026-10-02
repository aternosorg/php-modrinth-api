<?php

namespace Aternos\ModrinthApi\Client\Threads;

use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use Aternos\ModrinthApi\Client\User;
use Aternos\ModrinthApi\Client\Version;
use Aternos\ModrinthApi\Model\Report as ReportModel;
use Exception;

class Report
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected ReportModel $report,
    )
    {
    }

    /**
     * @return ReportModel
     */
    public function getData(): ReportModel
    {
        return $this->report;
    }

    /**
     * @return ReportItemType
     */
    public function getItemType(): ReportItemType
    {
        return ReportItemType::from($this->report->getItemType());
    }

    /**
     * Fetch the full project from the API if the report is a project report
     * @return Project
     * @throws ApiException
     * @throws Exception
     */
    public function getProject(): Project
    {
        if ($this->getItemType() !== ReportItemType::PROJECT) {
            throw new Exception("Report is not a project report");
        }

        return $this->client->getProject($this->report->getItemId());
    }

    /**
     * Fetch the full user from the API if the report is a user report
     * @return User
     * @throws ApiException
     * @throws Exception
     */
    public function getUser(): User
    {
        if ($this->getItemType() !== ReportItemType::USER) {
            throw new Exception("Report is not a user report");
        }

        return $this->client->getUser($this->report->getItemId());
    }

    /**
     * Fetch the full version from the API if the report is a version report
     * @return Version
     * @throws ApiException
     * @throws Exception
     */
    public function getVersion(): Version
    {
        if ($this->getItemType() !== ReportItemType::VERSION) {
            throw new Exception("Report is not a version report");
        }

        return $this->client->getVersion($this->report->getItemId());
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
        $this->client->modifyReport($this->report->getId(), $body, $closed);
        return $this;
    }


}