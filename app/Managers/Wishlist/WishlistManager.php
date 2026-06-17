<?php

namespace App\Managers\Wishlist;

use App\Managers\Wishlist\Contracts\DatabaseWishlistStoreInterface;
use App\Managers\Wishlist\DataTransferObjects\StoreWishlistDTO;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;

class WishlistManager implements DatabaseWishlistStoreInterface
{
    public function store(StoreWishlistDTO $movieDTO): ?Wishlist
    {
        try {
            return Wishlist::create($movieDTO->toArray());
        } catch (\Exception $exception) {
            Log::error("Wishlist database insert error: {$exception->getMessage()}");
            return null;
        }
    }
}
