<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    protected $table = 'races';

    protected $fillable = [
        'origin_id',
        'destination_id',
        'driver_id',
        'vehicle_id',
        'race_data',
        'departure_time',
        'arrival_time',
        'available_seats',
        'total_seats',
        'suggested_value',
        'observations',
        'status'
    ];

    public function passengers()
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

    public function destination():BelongsTo
    {
        return $this->belongsTo(Address::class, 'destination_id');
    }

    public function driver(): belongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle(): belongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
