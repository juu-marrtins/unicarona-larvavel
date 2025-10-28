<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'RA',
        'phone',
        'photo',
        'user_type',
        'user_title',
        'status',
        'cpf',
        'institution_id',
        'role_id',
        'course'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'cpf'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicles::class);
    }

    public function racePassengers(): HasMany
    {
        return $this->hasMany(RacePassenger::class, 'passenger_id');
    }

    public function driverDocuments(): HasOne
    {
        return $this->hasOne(DriverDocument::class, 'user_id');
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Review::class, 'evaluated_id');
    }

    public function appraisals(): HasMany
    {
        return $this->hasMany(Review::class, 'appraised_id');
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
