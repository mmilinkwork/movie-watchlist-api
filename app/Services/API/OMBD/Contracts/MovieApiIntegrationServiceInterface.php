<?php

namespace App\Services\API\OMBD\Contracts;

use App\Services\Movies\DataTransferObjects\AddMovieToWatchlistDTO;
use App\Services\Movies\DataTransferObjects\MovieDTO;

interface MovieApiIntegrationServiceInterface
{
    public function get(AddMovieToWatchlistDTO $addMovieToWatchlistDTO): MovieDTO;
}
