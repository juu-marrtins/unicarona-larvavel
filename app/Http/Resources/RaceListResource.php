<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaceListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [  
            'id' => $this->id,
            'driver_id' => $this->driver_id,
            'driver_name' => $this->driver->name,
            'driver_title' => match($this->driver->user_title)
            {
                'student' => 'Estudante',
                'teacher' =>  'Professor',
                'employee' => 'Funcionario',
                default => 'Estudante'
            },
            'destiny' => $this->destination->street . ' - ' . $this->destination->number . ' - ' . $this->destination->district . ' - ' . $this->destination->city . ' - ' . $this->destination->state,
            'origin' => $this->origin->street . ' - ' . $this->origin->number . ' - ' . $this->origin->district . ' - ' . $this->origin->city . ' - ' . $this->origin->state,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'available_seats' => $this->available_seats,
            'value' => $this->suggested_value,
        ];
    }
}
