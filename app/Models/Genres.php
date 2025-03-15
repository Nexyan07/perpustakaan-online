<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genres extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'color',
    ];

    public function scopeFilter(Builder $query, array $filters) :void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn($query, $keyword) =>
            $query->where('name', 'like', '%' . $keyword . '%')->
            orWhere('color', 'like', '%' . $keyword . '%')
        );
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Books::class);
    }
}
