<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'overview',
        'poster_url',
        'backdrop_url',
        'rating',
        'release_date',
        'director',
        'duration',
    ];
}
