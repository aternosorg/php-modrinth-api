<?php

namespace Aternos\ModrinthApi\Client\Tags;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Model\DonationPlatformTag;

class DonationPlatform
{
    public function __construct(
        protected ModrinthAPIClient $client,
        protected DonationPlatformTag $data,
    )
    {
    }

    /**
     * @return DonationPlatformTag
     */
    public function getData(): DonationPlatformTag
    {
        return $this->data;
    }
}