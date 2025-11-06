<?php

namespace App\Http\Requests\Race;

use Illuminate\Foundation\Http\FormRequest;

class CreateRaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'origin_street' => 'required|string',
            'origin_number' => 'required|string',
            'origin_district' => 'required|string',
            'origin_city' => 'required|string',
            'origin_state' => 'required|string',
            'destination_street' => 'required|string',
            'destination_number' => 'required|string',
            'destination_district' => 'required|string',
            'destination_city' => 'required|string',
            'destination_state' => 'required|string',
            'arrival_time' => 'required|date',
            'departure_time' => 'required|date',
            'available_seats' => 'required|integer',
        ];
    }
}
