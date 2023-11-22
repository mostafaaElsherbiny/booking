<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TripStation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'booked_seats' => 'array'
    ];

    protected $appends = ['seats', 'available_seats'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function fromCity()
    {
        return $this->belongsTo(City::class, 'from');
    }

    public function toCity()
    {
        return $this->belongsTo(City::class, 'to');
    }
    public function scopeStationWithRightSequenceExist($q, $to)
    {
        return $q->whereExists(function ($query) use ($to) {
            $query->select(DB::raw(1))
                ->from('trip_stations as s2')
                ->whereColumn('s2.trip_id', 'trip_stations.trip_id')
                ->where('s2.order', '>=', DB::raw('trip_stations.order'))
                ->where('s2.to', $to);
        });;
    }


    public function generateSets($sets, $prefix)
    {
        $allSets = [];
        for ($i = 1; $i <= $sets; $i++) {
            $allSets[] = $prefix . $i;
        }
        return $allSets;
    }



    public function getSeatsAttribute()
    {
        return $this->generateSets($this->seats_limit, "set_");
    }

    public function getAvailableSeatsAttribute()
    {
        $seats = array_diff($this->seats, $this->booked_seats ?? []);

      

        return array_values($seats);
    }
}
