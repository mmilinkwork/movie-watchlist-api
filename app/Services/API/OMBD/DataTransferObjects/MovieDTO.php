<?php

namespace App\Services\API\OMBD\DataTransferObjects;

class MovieDTO
{
    public readonly string $imdbId;
    public readonly string $title;
    public readonly string $year;
    public readonly string $genre;
    public readonly string $director;
    public readonly string $plot;
    public readonly string $posterUrl;
    public readonly ?string $imdbRating;
    public readonly string $runtime;
    public readonly string $rawData;

    public function __construct(array $data)
    {
        $this->imdbId = $data['imdbID'];
        $this->title = $data['Title'];
        $this->year = $data['Year'];
        $this->genre = $data['Genre']; //can be enum
        $this->director = $data['Director'];
        $this->plot = $data['Plot'];
        $this->posterUrl = $data['Poster'];
        $this->imdbRating = $data['imdbRating'];
        $this->runtime = $data['Runtime'];
        $this->rawData = json_encode($data);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'imdb_id' => $this->imdbId,
            'title' => $this->title,
            'year' => $this->year,
            'genre' => $this->genre,
            'director' => $this->director,
            'plot' => $this->plot,
            'poster_url' => $this->posterUrl,
            'imdb_rating' => $this->imdbRating,
            'runtime' => $this->runtime,
        ];
    }
}
