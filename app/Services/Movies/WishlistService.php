<?php

namespace App\Services\Movies;

use App\Http\Resources\WishlistResource;
use App\Managers\Wishlist\Contracts\DatabaseWishlistStoreInterface;
use App\Managers\Wishlist\DataTransferObjects\StoreWishlistDTO;
use App\Managers\Wishlist\WishlistManager;
use App\Models\Wishlist;
use App\Services\API\OMBD\Contracts\OMBDServiceInterface;
use App\Services\API\OMBD\DataTransferObjects\FetchMovieDTO;
use App\Services\API\OMBD\OMBDService;
use App\Services\Movies\Contracts\AssignMovieToUserWishlistInterface;
use App\Services\Movies\DataTransferObjects\AssignMovieToUserDTO;

class WishlistService implements AssignMovieToUserWishlistInterface
{
    protected OMBDServiceInterface $OMBDService;
    protected DatabaseWishlistStoreInterface $wishListManager;

    public function __construct()
    {
        $this->OMBDService = resolve(OMBDService::class);
        $this->wishListManager = resolve(WishlistManager::class);
    }

    /**
     * Add movie to user wishlist.
     *
     * @param AssignMovieToUserDTO $assignMovieToUserDTO
     * @return void
     */
    public function assign(AssignMovieToUserDTO $assignMovieToUserDTO): Wishlist
    {
        $movie = $this->OMBDService->fetch(new FetchMovieDTO($assignMovieToUserDTO->toArray()));

       return $this->wishListManager->store(
            new StoreWishlistDTO(
                userId: $assignMovieToUserDTO->user->id,
                movieId:$movie->id,
            )
        );
    }
}
