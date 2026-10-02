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
    case CATEGORIES = "categories";
    case VERSIONS = "versions";
    case CLIENT_SIDE = "client_side";
    case SERVER_SIDE = "server_side";
    case OPEN_SOURCE = "open_source";


    case TITLE = "title";
    case AUTHOR = "author";
    case FOLLOWS = "follows";
    case PROJECT_ID = "project_id";
    case LICENSE = "license";
    case DOWNLOADS = "downloads";
    case COLOR = "color";
    case CREATED_TIMESTAMP = "created_timestamp";
    case MODIFIED_TIMESTAMP = "modified_timestamp";

    /**
     * @deprecated Use {@link FacetType::CREATED_TIMESTAMP} instead. This option doesn't work.
     */
    case DATE_CREATED = "date_created";
    /**
     * @deprecated Use {@link FacetType::MODIFIED_TIMESTAMP} instead. This option doesn't work.
     */
    case DATE_MODIFIED = "date_modified";
}
