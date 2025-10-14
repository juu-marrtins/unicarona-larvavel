<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function student(): HasMany
    {
        return $this->hasMany(User::class, 'student_id');
    }
}
