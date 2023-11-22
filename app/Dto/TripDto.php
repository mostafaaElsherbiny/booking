<?php

namespace App\Dto;

use DateTime;

class TripDto
{

    public function __construct(
        public readonly string $title,
        public readonly int $seats_limit,
        public readonly array $cities,
        public readonly DateTime $time,

    ) {
    }
}
