<?php

namespace Aternos\ModrinthApi\Client\List;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\SearchProject;
use Aternos\ModrinthApi\Model\ProjectResult;
use Aternos\ModrinthApi\Model\SearchResults;

/**
 * Class PaginatedProjectSearchList
 *
 * @description  This class represents a paginated list of projects.
 * @package Aternos\ModrinthApi\Client\List
 * @extends PaginatedList<SearchProject>
 */
class PaginatedProjectSearchList extends PaginatedList
{

    public function __construct(
        protected ModrinthAPIClient $client,
        protected ProjectSearchOptions $options,
        SearchResults $searchResults,
    )
    {
        parent::__construct(
            $searchResults->getOffset(),
            $searchResults->getLimit(),
            $searchResults->getTotalHits(),
            array_map(function (ProjectResult $project) {
                return new SearchProject($this->client, $project);
            }, $searchResults->getHits()),
        );
    }

    public function getOffset(int $offset): static
    {
        $options = clone $this->options;
        $options->setOffset($offset);
        return $this->client->searchProjects($options);
    }
}