<?php

namespace App\Services\API\OMBD;

use App\Services\API\OMBD\Contracts\MovieApiIntegrationServiceInterface;
use App\Services\API\OMBD\DataTransferObjects\FetchMovieDTO;
use App\Services\Movies\DataTransferObjects\MovieDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OMBDIntegrationService implements MovieApiIntegrationServiceInterface
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.ombd.base_url');
        $this->apiKey = config('services.ombd.api_key');
    }

    /**
     * Executes API call to third party API - OMBD API.
     *
     * @param FetchMovieDTO $addMovieToWatchlistDTO
     * @return MovieDTO
     */
    public function get(FetchMovieDTO $addMovieToWatchlistDTO): MovieDTO
    {
        try {
            $response = Http::timeout(5)->get($this->baseUrl, $this->createQueryString($addMovieToWatchlistDTO));
        } catch (\Throwable $e)
        {
            Log::error("Unable to reach OMDb API. {$e->getMessage()}");
        }

        if ($response->serverError() || $response->status() === 401)
        {
            Log::error("OMDb API returned an error: {$response->status()}");
        }

        return new MovieDTO($response->json());
    }

    /**
     * Create array that is required from OMBD API for query string.
     *
     * @param FetchMovieDTO $addMovieToWatchlistDTO
     * @return array
     */
    private function createQueryString(FetchMovieDTO $addMovieToWatchlistDTO): array
    {
        if ($addMovieToWatchlistDTO->isTitle)
        {
            return [
                't' => $addMovieToWatchlistDTO->title,
                'apiKey' => $this->apiKey
            ];
        }

        return [
            'i' => $addMovieToWatchlistDTO->ombd_id,
            'apiKey' => $this->apiKey
        ];
    }
}
