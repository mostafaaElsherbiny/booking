<?php

namespace App\Services\Api;

use App\Dto\BookDto;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class BookingService
{
    public function book(BookDto $data)
    {
        return DB::transaction(function () use ($data) {

            $seatNumber = $data->seat_number;


            $trip = Trip::with('stations')->findOrFail($data->trip_id);


            $allStations = $trip->stations
                ->filter(function ($station) use ($data) {
                    $valid = ($station->from == $data->from || $station->to == $data->to)
                        &&
                        (count($station->booked_seats ?? []) < $station->seats_limit);


                    return $valid;
                });

            if ($allStations->count() < 1) {
                return response()->json(['message' => 'Invalid stations'], 422);
            }

            $isSeatBooked = $allStations->pluck('booked_seats')
                ->flatten()
                ->contains($seatNumber);

            if ($isSeatBooked) {
                return response()->json(['message' => 'Seat already booked'], 422);
            }



            $fromStation = $trip->stations->where('from', $data->from)->first();

            $toStation = $trip->stations->where('to', $data->to)->first();


            if (!$fromStation || !$toStation || $fromStation->order > $toStation->order) {
                return response()->json(['message' => 'Invalid station sequence'], 422);
            }


            Booking::create([
                'trip_id'     => $trip->id,
                'from'        => $data->from,
                'to'          => $data->to,
                'seat_number' => $seatNumber,
            ]);

            $allStations->each(function ($station) use ($seatNumber) {

                $station->booked_seats = array_merge($station->booked_seats ?? [], [$seatNumber]);

                $station->save();
            });


            return response()->json(['message' => 'Trip booked successfully']);
        });
    }

  
}
