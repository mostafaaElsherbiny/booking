<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Dto\BookDto;
use App\Models\City;
use App\Models\Trip;
use App\Models\TripStation;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Services\Api\BookingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessfulBooking()
    { {
            $trip = Trip::factory()->create();

            $stations =  $trip->stations;

            $bookingService = new BookingService();

            $bookDto = new BookDto($trip->id, $stations[0]->from, $stations[1]->to, 'seat_1');

            $response = $bookingService->book($bookDto);

            $this->assertEquals(Response::HTTP_OK, $response->status());

            $this->assertEquals('Trip booked successfully', $response->getData()->message);

            $this->assertDatabaseHas('bookings', [
                'trip_id' => $trip->id,
                'from' => $stations[0]->from,
                'to' => $stations[1]->to,
                'seat_number' => 'seat_1',
            ]);
        }
    }


    public function testInvalidStations()
    {

        $trip = Trip::factory()->create();

        $bookingService = new BookingService();

        $bookDto = new BookDto(
            $trip->id,
            -1, // Invalid 'from' station ID
            -1, // Invalid 'to' station ID
            'seat_1'
        );

        $response = $bookingService->book($bookDto);

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());

        $this->assertEquals('Invalid stations', $response->getData()->message);
    }
}
