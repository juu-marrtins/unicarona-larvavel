<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'evaluated_id',
        'appraised_id',
        'race_id',
        'rating',
        'comment',
        'review_at'
    ];

    public function evaluated(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluated_id');
    }

    public function appraised(): BelongsTo
    {
        return $this->belongsTo(User::class, 'appraised_id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
}
