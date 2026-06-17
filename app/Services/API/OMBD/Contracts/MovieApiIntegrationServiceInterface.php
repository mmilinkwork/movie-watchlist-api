<?php

namespace App\Services\API\OMBD\Contracts;

use App\Services\API\OMBD\DataTransferObjects\FetchMovieDTO;
use App\Services\Movies\DataTransferObjects\MovieDTO;

interface MovieApiIntegrationServiceInterface
{
    public function get(FetchMovieDTO $addMovieToWatchlistDTO): MovieDTO;
}
