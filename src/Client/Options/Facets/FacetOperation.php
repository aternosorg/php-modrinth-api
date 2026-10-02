<?php

namespace Aternos\ModrinthApi\Client\Options\Facets;

enum FacetOperation: string
{
    case EQUALS = "=";
    case NOT_EQUALS = "!=";
    case GREATER_THAN = ">";
    case GREATER_THAN_OR_EQUALS = ">=";
    case LESS_THAN = "<";
    case LESS_THAN_OR_EQUALS = "<=";
}