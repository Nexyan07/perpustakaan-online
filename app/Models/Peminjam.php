<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjam extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tenggat_pengembalian',
        'tanggal_pengembalian',
        'dirating',
    ];

    public function scopeFilter(Builder $query, array $filters) :void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn($query, $keyword) =>
            $query->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('book', function ($q) use ($keyword) {
                $q->where('title' , 'like', '%' . $keyword . '%');
            })->orWhere('tanggal_pinjam', 'like', $keyword)->
            orWhere('tenggat_pengembalian', 'like', $keyword)->
            orWhere('tanggal_pengembalian', 'like', $keyword)
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
