<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    public const GENRES = ['Action', 'Comedy', 'Drama', 'Horror', 'Romance', 'Sci-Fi', 'Animasi'];

    protected $guarded = [];

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, fn (Builder $q) => $q->where('title', 'like', '%'.$term.'%'));
    }

    public function scopeGenre(Builder $query, ?string $genre): Builder
    {
        return $query->when($genre, fn (Builder $q) => $q->where('genre', $genre));
    }

    public function scopeInWatchlist(Builder $query): Builder
    {
        return $query->whereHas('wishlists');
    }
}
