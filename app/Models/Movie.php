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

    /**
     * Users who have this movie on their wishlist.
     */
    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists')
            ->withPivot('status', 'personal_rating', 'watched_at', 'is_favorite')
            ->withTimestamps();
    }

}
