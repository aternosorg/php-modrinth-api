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
    case CATEGORIES = "categories";
    case VERSIONS = "versions";
    case LICENSE = "license";
    case PROJECT_TYPE = "project_type";
}