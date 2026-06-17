<?php

namespace App\Managers\Wishlist\DataTransferObjects;

use Carbon\Carbon;

class StoreWishlistDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly int $movieId,
        public readonly string $status = 'added',
        public readonly ?int $personalRating = null,
        public readonly ?Carbon $watchedAt = null,
        public readonly bool $isFavorite = false,
    ) {}

    /**
     * Convert DTO to an array ready for the Wishlist model.
     */
    public function toArray(): array
    {
        return array_filter([
            'user_id'         => $this->userId,
            'movie_id'        => $this->movieId,
            'status'          => $this->status,
            'personal_rating' => $this->personalRating,
            'watched_at'      => $this->watchedAt,
            'is_favorite'     => $this->isFavorite,
        ], fn($value) => $value !== null);
    }
}
