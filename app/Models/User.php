<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'foto',
        'name',
        'address',
        'telepon',
        'email',
        'password',
        'role'
    ];

    public function scopeFilter(Builder $query, array $filters) :void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn($query, $keyword) =>
            $query->where('name', 'like', '%' . $keyword . '%')->
            orWhere('address', 'like', '%' . $keyword . '%')->
            orWhere('email', 'like', '%' . $keyword . '%')->
            orWhere('telepon', 'like', $keyword)->
            orWhere('role', 'like', $keyword)
        );
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservations::class);
    }

    public function peminjam(): HasMany
    {
        return $this->hasMany(Peminjam::class);
    }

    public function rating(): HasMany
    {
        return $this->hasMany(Ratings::class);
    }

    public function fine(): HasMany
    {
        return $this->hasMany(Fines::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
}
