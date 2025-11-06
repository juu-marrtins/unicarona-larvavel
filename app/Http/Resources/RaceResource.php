<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'driver' => $this->driver_id,
            'vehicle' => $this->vehicle_id,
            'origin' => $this->origin->street . " - " . $this->origin->number . " - " . $this->origin->district . " - " . $this->origin->city . " - " . $this->origin->state,
            'destination' => $this->destination->street . " - " . $this->destination->number . " - " . $this->destination->district . " - " . $this->destination->city . " - " . $this->destination->state,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'total_seats' => $this->total_seats,
            'available_seats' => $this->available_seats,
            'status' => $this->status,
        ];
    }
}
