<?php

namespace App\Services\API\OMBD;

use App\Services\API\OMBD\Contracts\MovieApiIntegrationServiceInterface;
use App\Services\Movies\Contracts\StoreMovieInterface;
use App\Services\Movies\DataTransferObjects\AddMovieToWatchlistDTO;
use App\Services\Movies\DataTransferObjects\MovieDTO;
use App\Services\Movies\MovieService;

class OMBDService implements Contracts\OMBDServiceInterface
{
    protected StoreMovieInterface $movieService;

    public function __construct(protected MovieApiIntegrationServiceInterface $movieApiIntegrationService)
    {
        $this->movieService = resolve(MovieService::class);
    }

    /**
     * Based on ombd_id or title, we are fetching Movie from API or from Database/Cache.
     * If movie already exists in Database, we will not call API request.
     *
     * @param AddMovieToWatchlistDTO $addMovieToWatchlistDTO
     * @return MovieDTO|null
     */
    public function fetch(AddMovieToWatchlistDTO $addMovieToWatchlistDTO): ?MovieDTO
    {

        if (!$this->movieExists($addMovieToWatchlistDTO))
        {
            return $this->movieApiIntegrationService->get($addMovieToWatchlistDTO);
        }


        return $this->returnExistingMovie();
    }

    /**
     * Return from Database/Cache movie if it already exists.
     *
     * @return MovieDTO
     */
    private function returnExistingMovie(): MovieDTO
    {
        return new MovieDTO([
            'imdbID'   => 'tt1375666',
            'Title'    => 'Inception',
            'Year'     => '2010',
            'Genre'    => 'Action, Adventure, Sci-Fi',
            'Director' => 'Christopher Nolan',
            'Plot'     => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.',
            'Poster'   => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg',
            'imdbRating' => '8.8',
            'Runtime'  => '148 min',
        ]);
    }

    /**
     * Check if movie already exists in Database.
     *
     * @param AddMovieToWatchlistDTO $addMovieToWatchlistDTO
     * @return false
     */
    private function movieExists(AddMovieToWatchlistDTO $addMovieToWatchlistDTO)
    {
        //to do
        return false;
    }
}
