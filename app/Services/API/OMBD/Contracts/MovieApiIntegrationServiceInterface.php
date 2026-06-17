<?php

namespace App\Services\API\OMBD\Contracts;

use App\Services\API\OMBD\DataTransferObjects\AddMovieToWatchlistDTO;
use App\Services\API\OMBD\DataTransferObjects\MovieDTO;

interface MovieApiIntegrationServiceInterface
{
    public function get(AddMovieToWatchlistDTO $addMovieToWatchlistDTO): MovieDTO;
}
