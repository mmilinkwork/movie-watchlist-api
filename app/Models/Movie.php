<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'imdb_id',
        'title',
        'year',
        'genre',
        'director',
        'plot',
        'poster_url',
        'imdb_rating',
        'runtime'
    ];
}
