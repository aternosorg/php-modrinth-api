<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Model\DonationPlatformTag;

class DonationPlatform extends DonationPlatformTag
{
    public function __construct(
        protected ModrinthAPIClient $client,
        DonationPlatformTag $data,
    )
    {
        parent::__construct($data->container);
    }
}
