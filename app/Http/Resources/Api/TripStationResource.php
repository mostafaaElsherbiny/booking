<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripStationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            'from' => new CityResource($this->whenLoaded('fromCity')),
            'to' => new CityResource($this->whenLoaded('toCity')),
            'seats_limit' => $this->seats_limit,
            'booked_seats' => $this->booked_seats,
            'available_seats' => $this->available_seats
        ];
    }
}
