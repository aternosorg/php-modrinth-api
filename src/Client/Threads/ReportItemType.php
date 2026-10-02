<?php

namespace Aternos\ModrinthApi\Client\Threads;

enum ReportItemType: string
{
    case PROJECT = "project";
    case USER = "user";
    case VERSION = "version";
}