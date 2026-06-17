<?php

namespace App\Managers\Movies\Contracts;

use App\Services\API\OMBD\DataTransferObjects\MovieDTO;
use Illuminate\Support\Collection;

interface DatabaseMovieStoreInterface
{
    public function store(MovieDTO $movieDTO): void;

    public function bulkStore(Collection $movies): void;
}
