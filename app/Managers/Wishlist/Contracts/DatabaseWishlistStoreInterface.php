<?php

namespace App\Managers\Wishlist\Contracts;

use App\Managers\Wishlist\DataTransferObjects\StoreWishlistDTO;

interface DatabaseWishlistStoreInterface
{
    public function store(StoreWishlistDTO $movieDTO): void;
}
