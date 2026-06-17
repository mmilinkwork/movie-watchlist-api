<?php

namespace App\Http\Controllers;

use App\Http\Requests\Watchlist\AddWatchlistRequest;
use App\Http\Resources\WishlistResource;
use App\Services\Movies\Contracts\AssignMovieToUserWishlistInterface;
use App\Services\Movies\DataTransferObjects\AssignMovieToUserDTO;
use App\Services\Movies\WishlistService;
use Illuminate\Support\Facades\Auth;

class AddToWatchlistController extends Controller
{
    protected AssignMovieToUserWishlistInterface $wishlistService;

    public function __construct()
    {
        $this->wishlistService = new WishlistService();
    }

    public function index(AddWatchlistRequest $addWatchlistRequest)
    {
        $wishlist = $this->wishlistService->assign(new AssignMovieToUserDTO(
            user: Auth::user(),
            isTitle: $addWatchlistRequest->validated('isTitle'),
            title: $addWatchlistRequest->validated('title'),
            ombd_id: $addWatchlistRequest->validated('ombd_id')
        ));

        if ($wishlist) {
            return response()->json(WishlistResource::make($wishlist), 201);
        }

        return response()->json([
            'message' => 'Movie already exists in your wishlist',
            'error' => 'Duplicate entry'
        ], 409);
    }
}
