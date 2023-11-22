<?php

namespace App\Repositories\Api;

use App\Models\Trip;

class TripRepository
{

    public function getTrips($from, $to)
    {
        return Trip::with(
            [
                'stations' => fn ($q)  => $q
                    ->where('from', $from)
                    ->orWhere('to', $to)
                    ->stationWithRightSequenceExist($to)
                    ->whereRaw('JSON_LENGTH(trip_stations.booked_seats) < seats_limit'),
                'stations.fromCity',
                'stations.toCity'
            ]
        )
            ->whereHas(
                'stations',
                fn ($q) => $q
                    ->stationWithRightSequenceExist($to)
                    ->where('from', $from)
                    ->whereRaw('JSON_LENGTH(trip_stations.booked_seats) < seats_limit')
            )

            ->get();
    }
}
