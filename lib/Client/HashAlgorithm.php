<?php

namespace Aternos\ModrinthApi\Client;

enum HashAlgorithm: string
{
    case SHA1 = "sha1";
    case SHA512 = "sha512";
}