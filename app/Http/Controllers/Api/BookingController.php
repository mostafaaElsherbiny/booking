<?php

namespace App\Http\Controllers\Api;

use App\Dto\BookDto;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\BookingService;
use App\Http\Requests\Api\BookingRequest;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function __construct(public BookingService $bookingService)
    {
    }
    public function store(BookingRequest $request)
    {
        try {
            $bookingData = new BookDto(
                $request->trip_id,
                $request->from,
                $request->to,
                $request->seat_number
            );
            return $this->bookingService->book($bookingData);
        } catch (\Throwable $th) {

            Log::alert($th);
            return response()->json(['message' => $th->getMessage()], 422);
        }
    }
}
