<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Institution extends Model
{
    protected $table = 'institutions';

    protected $fillable = [
        'name',
        'email_domain',
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
