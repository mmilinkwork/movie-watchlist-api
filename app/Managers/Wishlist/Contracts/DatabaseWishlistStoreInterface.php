<?php

namespace App\Managers\Wishlist\Contracts;

use App\Managers\Wishlist\DataTransferObjects\StoreWishlistDTO;
use App\Models\Wishlist;

interface DatabaseWishlistStoreInterface
{
    public function store(StoreWishlistDTO $movieDTO): ?Wishlist;
}
