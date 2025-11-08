<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'origin_id' => $this->origin_id,
            'destination_id' => $this->destination_id,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'status' => $this->status,
            'available_seats' => $this->available_seats,
            'passengers' => $this->passengers->map(fn($p) => [
                'id' => $p->id,
                'status' => $p->status,
                'user' => [
                    'id' => $p->passenger->id,
                    'name' => $p->passenger->name,
                    'type' => $p->passenger->user_title,
                ],
            ]),
        ];
    }
}
