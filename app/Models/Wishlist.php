<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'status',
        'personal_rating',
        'watched_at',
        'is_favorite',
    ];

    /**
     * Get the user that owns this wishlist entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the movie associated with this wishlist entry.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
