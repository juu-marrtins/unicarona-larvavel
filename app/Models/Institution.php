<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $fillable = [
        'name',
        'validator',
        'city',
        'state',
        'cnpj'
    ];

    public function student(): HasOne
    {
        return $this->hasOne(User::class, 'institution_id', 'id');
    }
}
