<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    protected $table = 'races';

    protected $fillable = [
        'origin_id',
        'destination_id',
        'driver_id',
        'vehicle_id',
        'race_data',
        'departure_date',
        'arrival_date',
        'available_seats',
        'total_seats',
        'suggested_value',
        'observations',
        'status'
    ];

    public function racePassengers()
    {
        return $this->hasMany(RacePassenger::class, 'race_id');
    }

    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'race_id');
    }

    public function origin():BelongsTo
    {
        return $this->belongsTo(Address::class, 'origin_id');
    }

    public function destiny():BelongsTo
    {
        return $this->belongsTo(Address::class, 'destination_id');
    }

    public function driver(): belongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
