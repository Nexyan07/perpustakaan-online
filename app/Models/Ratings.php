<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ratings extends Model
{
    protected $fillable = ['user_id', 'book_id', 'rating'];

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn ($query, $keyword) =>
            $query->where('rating', 'like', '%' . $keyword . '%')->
            orWhereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('book', function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%');
            })
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'book_id', 'id');
    }
}
