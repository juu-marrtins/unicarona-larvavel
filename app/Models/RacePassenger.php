<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RacePassenger extends Model
{
    protected $table = 'race_passengers';
    
    protected $fillable = [
        'passenger_id', 
        'race_id',         
        'status',
        'request_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
}
