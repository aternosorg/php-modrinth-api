<?php

namespace Aternos\ModrinthApi\Client\Options;

/**
 * Class ProjectSearchOptions
 *
 * @description You can order search results by any of these values.
 * @package Aternos\ModrinthApi\Client\Options
 */
enum SearchIndex: string
{
    case RELEVANCE = "relevance";
    case DOWNLOADS = "downloads";
    case FOLLOWS = "follows";
    case NEWEST = "newest";
    case UPDATED = "updated";
}
