<?php

namespace App\Managers\Movies;

use App\Managers\Movies\Contracts\DatabaseMovieStoreInterface;
use App\Models\Movie;
use App\Services\API\OMBD\DataTransferObjects\MovieDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MovieManager implements DatabaseMovieStoreInterface
{
    public function store(MovieDTO $movieDTO): void
    {
        try {
            Movie::insert($movieDTO->toArray());
        } catch (\Exception $exception) {
            Log::error("Unsuccessful database insertion: {$exception->getMessage()}");
        }
    }

    public function bulkStore(Collection $movies): void
    {
        // TODO: Implement bulkStore() method.
    }
}
