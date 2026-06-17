<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'user_id'         => $this->user_id,
            'movie_id'        => $this->movie_id,
            'status'          => $this->status,
            'personal_rating' => $this->personal_rating,
            'watched_at'      => $this->watched_at?->toIso8601String(),
            'is_favorite'     => (bool) $this->is_favorite,
            'created_at'      => $this->created_at?->toIso8601String(),
            'updated_at'      => $this->updated_at?->toIso8601String(),

            // Include the full movie details if the relationship is loaded
//            'movie'           => $this->whenLoaded('movie', function () {
//                return MovieResource::make($this->movie);
//            }),
        ];
    }
}
