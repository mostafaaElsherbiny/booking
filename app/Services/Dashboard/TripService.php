<?php

namespace App\Services\Dashboard;

use App\Dto\TripDto;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\TripStation;
use Illuminate\Support\Facades\DB;


class TripService
{
    public function store(TripDto $data)
    {
        return DB::transaction(function () use ($data) {

            $trip = Trip::create([
                'title' => $data->title,
                'seats_limit' => $data->seats_limit,
                'time' => $data->time,
            ]);
            foreach ($data->cities as $key => $city) {
                if ($key == count($data->cities) - 1) break;
                TripStation::updateOrCreate(
                    [
                        'trip_id' => $trip->id,
                        'from' => $city,
                    ],
                    [
                        'trip_id' => $trip->id,
                        'from' => $city,
                        'order' => $key + 1,
                        'seats_limit' => $data->seats_limit,
                        'to' => $data->cities[$key + 1],
                    ]
                );
            }
            return $trip;
        });
    }
}
