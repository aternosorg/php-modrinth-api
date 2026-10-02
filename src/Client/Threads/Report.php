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
     * Fetch the full project from the API if the report is a project report
     * @return Project
     * @throws ApiException
     * @throws Exception
     */
    public function getProject(): Project
    {
        if ($this->getItemTypeEnum() !== ReportItemType::PROJECT) {
            throw new Exception("Report is not a project report");
        }

        return $this->client->getProject($this->getItemId());
    }

    /**
     * Fetch the full user from the API if the report is a user report
     * @return User
     * @throws ApiException
     * @throws Exception
     */
    public function getUser(): User
    {
        if ($this->getItemTypeEnum() !== ReportItemType::USER) {
            throw new Exception("Report is not a user report");
        }

        return $this->client->getUser($this->getItemId());
    }

    /**
     * Fetch the full version from the API if the report is a version report
     * @return Version
     * @throws ApiException
     * @throws Exception
     */
    public function getVersion(): Version
    {
        if ($this->getItemTypeEnum() !== ReportItemType::VERSION) {
            throw new Exception("Report is not a version report");
        }

        return $this->client->getVersion($this->getItemId());
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
