<?php

namespace App\Services\API\OMBD\Contracts;

use App\Models\Movie;
use App\Services\API\OMBD\DataTransferObjects\FetchMovieDTO;

interface OMBDServiceInterface
{
    public function fetch(FetchMovieDTO $fetchMovieDTO): Movie;
}
