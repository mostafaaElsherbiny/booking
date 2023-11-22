<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;

class CityController extends Controller
{
    /**
     * Display a listing of the trip.
     */
    public function index()
    {
        return CityResource::collection(City::all());
    }
}
