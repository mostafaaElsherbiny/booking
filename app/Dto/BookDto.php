<?php

namespace App\Dto;

class BookDto
{
    public $trip_id;
    public $from;
    public $to;
    public $seat_number;

    public function __construct($trip_id, $from, $to, $seat_number)
    {
        $this->trip_id = $trip_id;
        $this->from = $from;
        $this->to = $to;
        $this->seat_number = $seat_number;
    }
}
