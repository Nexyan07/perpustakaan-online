<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BooksGenres extends Model
{
    use HasFactory;
    protected $fillable = [
        'genres_id',
        'books_id',
    ];

    public function scopeFilter(Builder $query, array $filters) :void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn($query, $keyword) =>
            $query->whereHas('books', function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%');
            })->orWhereHas('genres', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
        );
    }

    public function books()
    {
        return $this->belongsTo(Books::class, 'books_id');
    }

    public function genres()
    {
        return $this->belongsTo(Genres::class, 'genres_id');
    }
}
