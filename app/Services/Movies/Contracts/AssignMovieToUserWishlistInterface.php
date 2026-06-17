<?php

namespace App\Services\Movies\Contracts;

use App\Models\Wishlist;
use App\Services\Movies\DataTransferObjects\AssignMovieToUserDTO;

interface AssignMovieToUserWishlistInterface
{
    public function assign(AssignMovieToUserDTO $assignMovieToUserDTO): Wishlist;
}
