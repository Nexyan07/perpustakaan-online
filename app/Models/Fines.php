<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fines extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'jumlah',
        'status_pembayaran',
        'alasan',
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
            })->orWhere('jumlah', 'like', '%' . $keyword . '%')->
            orWhere('status_pembayaran', 'like', '%' . $keyword . '%')
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
