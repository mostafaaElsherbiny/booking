<?php

namespace App\Http\Controllers\Dashboard;

use App\Dto\TripDto;
use App\Models\City;
use App\Models\Trip;
use App\Models\TripStation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Repositories\Dashboard\TripRepository;
use App\Services\Dashboard\TripService;

class TripController extends Controller
{

    public function __construct(public TripRepository $tripRepository, public TripService $tripService)
    {
    }
    /**
     * Display a listing of the trip.
     */
    public function index()
    {
        $trips = $this->tripRepository->get();
        return view('dashboard.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new trip.
     */
    public function create()
    {
        $cities = City::all();

        return view('dashboard.trips.create', compact('cities'));
    }

    /**
     * Store a newly created trip in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $validated = $request->validated();

        $tripData = new TripDto(
            $validated['title'],
            $validated['seats_limit'],
            $validated['cities'],
            new \DateTime($validated['time'])
        );


        $trip = $this->tripService->store($tripData);

        return redirect()->route('dashboard.trips.index');
    }

    /**
     * Display the specified trip.
     */
    public function show(Trip $trip)
    {
        return view('dashboard.trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified trip.
     */
    public function edit(Trip $trip)
    {
        $cities = City::all();

        return view('dashboard.trips.edit', compact('trip', 'cities'));
    }

    /**
     * Update the specified trip in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $data = $request->validated();

        $trip->update($data);

        $trip->cityTrip()->delete();

        foreach ($data['cities'] as $key => $city) {
            $trip->cityTrip()->create([
                'city_id' => $city,
                'order' => $key + 1,
            ]);
        }

        return redirect()->route('dashboard.trips.index');
    }

    /**
     * Remove the specified trip from storage.
     */
    public function destroy(Trip $trip)
    {

        $trip->delete();

        return redirect()->route('dashboard.trips.index');
    }
}
