<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservations extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'reserved_at',
        'expiration_date',
    ];

    public function scopeFilter(Builder $query, array $filters) :void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn($query, $keyword) =>
            $query->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('book', function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%');
            })->orWhere('reserved_at', 'like', '%' . $keyword . '%')->orWhere('expiration_date', 'like', '%' . $keyword . '%')
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class);
    }
}
