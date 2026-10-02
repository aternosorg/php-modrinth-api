<?php

namespace Aternos\ModrinthApi\Client\Options\Facets;

/**
 * Class FacetType
 *
 * @description The type of facet.
 * @package Aternos\ModrinthApi\Client\Options\Facets
 */
enum FacetType: string
{
    case PROJECT_TYPE = "project_type";
    /**
     * loaders are lumped in with categories in search
     */
    case CATEGORIES = "categories";
    case VERSIONS = "versions";
    case OPEN_SOURCE = "open_source";

    /**
     * The environments a project supports, e.g. "client_and_server" or "server_only".
     * Replaces the previous {@code CLIENT_SIDE} and {@code SERVER_SIDE}.
     * @see \Aternos\ModrinthApi\Model\EnvironmentEnum
     */
    case ENVIRONMENT = "environment";

    /**
     * Matches against every project type across all of the project’s versions, not just the primary/version-specific type
     */
    case ALL_PROJECT_TYPES = "all_project_types";

    /**
     * Disclosures listed on a project, e.g. "ai_content" or "telemetry".
     * @see \Aternos\ModrinthApi\Model\DisclosureTypeEnum
     */
    case DISCLOSURE_TYPES = "disclosure_types";

    case TITLE = "title";
    case AUTHOR = "author";
    case FOLLOWS = "follows";
    case PROJECT_ID = "project_id";
    case LICENSE = "license";
    case DOWNLOADS = "downloads";
    case COLOR = "color";
    case CREATED_TIMESTAMP = "created_timestamp";
    case MODIFIED_TIMESTAMP = "modified_timestamp";
}
