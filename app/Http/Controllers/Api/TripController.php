<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TripResource;
use App\Repositories\Api\TripRepository;

class TripController extends Controller
{


    public function __construct(public TripRepository $tripRepository)
    {
    }
    /**
     * Display a listing of the trip.
     */
    public function index(Request $request)
    {

        try {
            $trips = $this
                ->tripRepository
                ->getTrips($request->from, $request->to);

            return TripResource::collection($trips);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
