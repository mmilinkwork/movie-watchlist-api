<?php

namespace App\Http\Controllers;

use App\Http\Requests\Watchlist\AddWatchlistRequest;
use App\Services\API\OMBD\Contracts\OMBDServiceInterface;
use App\Services\API\OMBD\DataTransferObjects\AddMovieToWatchlistDTO;

class AddToWatchlistController extends Controller
{
    public function __construct(private OMBDServiceInterface $OMBDService)
    {
    }

    public function index(AddWatchlistRequest $addWatchlistRequest)
    {
        $this->OMBDService->fetch(new AddMovieToWatchlistDTO($addWatchlistRequest->validated()));


    }
}
