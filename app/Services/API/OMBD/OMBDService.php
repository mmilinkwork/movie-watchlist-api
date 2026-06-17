<?php

namespace App\Services\API\OMBD;

use App\Managers\Movies\Contracts\DatabaseMovieStoreInterface;
use App\Managers\Movies\MovieManager;
use App\Models\Movie;
use App\Services\API\OMBD\Contracts\MovieApiIntegrationServiceInterface;
use App\Services\API\OMBD\DataTransferObjects\FetchMovieDTO;
use App\Services\API\OMBD\DataTransferObjects\MovieDTO;

class OMBDService implements Contracts\OMBDServiceInterface
{
    protected DatabaseMovieStoreInterface $movieManager;

    public function __construct(
        protected MovieApiIntegrationServiceInterface $movieApiIntegrationService,
    )
    {
        $this->movieManager = new MovieManager();
    }

    /**
     * Based on ombd_id or title, we are fetching Movie from API or from Database/Cache.
     * If movie already exists in Database, we will not call API request.
     * If movie doesn't exist, we will fetch it from API and store it to database.
     *
     * @param FetchMovieDTO $addMovieToWatchlistDTO
     * @return MovieDTO|null
     */
    public function fetch(FetchMovieDTO $fetchMovieDTO): Movie
    {
        if (!$this->movieExists($fetchMovieDTO))
        {
            $movieDTO = $this->movieApiIntegrationService->get($fetchMovieDTO);

            $this->movieManager->store($movieDTO);

            return $movieDTO;
        }

        return $this->returnExistingMovie($fetchMovieDTO);
    }

    /**
     * Return from Database/Cache movie if it already exists.
     *
     * @return MovieDTO
     */
    private function returnExistingMovie(FetchMovieDTO $fetchMovieDTO): Movie
    {
        return Movie::where('title', $fetchMovieDTO->title)
                    ->orWhere('imdb_id', $fetchMovieDTO->ombd_id)
                    ->first();
    }

    /**
     * Check if movie already exists in Database.
     *
     * @param FetchMovieDTO $addMovieToWatchlistDTO
     * @return false
     */
    private function movieExists(FetchMovieDTO $fetchMovieDTO): bool
    {
        return Movie::where('title', $fetchMovieDTO->title)
                    ->orWhere('imdb_id', $fetchMovieDTO->ombd_id)
                    ->exists();
    }
}
