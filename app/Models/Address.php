<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'street',
        'city',
        'number',
        'district',
        'state',
        'cep',
        'complement',
        'latitude',
        'longitude'
    ];

    public function destinyRaces(): HasMany
    {
        return $this->hasMany(Race::class, 'destination_id');
    }

    public function originRaces(): HasMany
    {
        return $this->hasMany(Race::class, 'origin_id');
    }
}
