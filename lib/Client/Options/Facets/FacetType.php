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
    case DATE_MODIFIED = "date_modified";
    case FOLLOWS = "follows";
    case PROJECT_ID = "project_id";
    case LICENSE = "license";
    case DATE_CREATED = "date_created";
    case DOWNLOADS = "downloads";
    case COLOR = "color";
}
