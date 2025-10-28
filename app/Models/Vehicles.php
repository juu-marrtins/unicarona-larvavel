<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicles extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'name',
        'model',
        'year',
        'color',
        'status',
        'brand',
        'capacity',
        'plate',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
