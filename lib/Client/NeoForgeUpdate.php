<?php

namespace Aternos\ModrinthApi\Client;

enum NeoForgeUpdate: string
{
    /**
     * NeoForge-only versions
     */
    case ONLY = "only";

    /**
     * both Forge and NeoForge versions
     */
    case INCLUDE = "include";

    /**
     * Forge-only versions
     */
    case OMITTED = "omitted";
}
