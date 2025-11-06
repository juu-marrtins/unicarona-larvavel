<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DriverDocument extends Model
{
    use HasFactory;


    protected $table = 'driver_documents';

    protected $fillable = [
        'user_id', 
        'cnh_number',
        'cnh_category',
        'expires_at',
        'status',
        'validated_at',
        'validator'
    ];

        public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
