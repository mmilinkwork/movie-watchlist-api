<?php

namespace App\Services\API\OMBD\Contracts;

use App\Services\API\OMBD\DataTransferObjects\FetchMovieDTO;
use App\Services\API\OMBD\DataTransferObjects\MovieDTO;

interface MovieApiIntegrationServiceInterface
{
    public function get(FetchMovieDTO $fetchMovieDTO): MovieDTO;
}
