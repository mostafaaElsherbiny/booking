<?php

namespace App\Repositories\Dashboard;

use App\Models\Trip;

class TripRepository
{

    public function get()
    {
        return  Trip::with('stations.fromCity', 'stations.toCity')->paginate();
    }
}
