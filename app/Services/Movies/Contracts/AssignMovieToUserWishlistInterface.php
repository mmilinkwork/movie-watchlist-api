<?php

namespace App\Services\Movies\Contracts;

use App\Services\Movies\DataTransferObjects\AssignMovieToUserDTO;

interface AssignMovieToUserWishlistInterface
{
    public function assign(AssignMovieToUserDTO $assignMovieToUserDTO): void;
}
