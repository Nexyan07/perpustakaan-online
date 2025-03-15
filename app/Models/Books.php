<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'rating',
        'isbn',
        'copies_total',
        'copies_available',
        'foto',
        'description',
        'slug',
    ];

    public function scopeFilter(Builder $query, array $filters) :void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn($query, $keyword) =>
            $query->where('title', 'like', '%' . $keyword . '%')->
            orWhere('author', 'like', '%' . $keyword . '%')->
            orWhere('publisher', 'like', '%' . $keyword . '%')->
            orWhere('year', 'like', $keyword)->
            orWhere('isbn', 'like', '%' . $keyword . '%')->
            orWhereHas('genres', fn($query) => $query->where('name', 'like', '%' . $keyword . '%'))
        );
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class);
    }

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservations::class);
    }

    public function peminjam(): HasMany
    {
        return $this->hasMany(Peminjam::class);
    }

    public function fine(): HasMany
    {
        return $this->hasMany(Fines::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Ratings::class, 'book_id');
    }
}
