<?php

namespace App\Services\API\OMBD\DataTransferObjects;

class FetchMovieDTO
{
    public readonly bool $isTitle;
    public readonly ?string $title;
    public readonly ?string $ombd_id;

    public function __construct(array $data)
    {
        $this->isTitle = $data['isTitle'];
        $this->title = $data['title'] ?? null;
        $this->ombd_id = $data['ombd_id'] ?? null;
    }

    public function toArray()
    {
        return [
            'isTitle' => $this->isTitle,
            'title' => $this->title,
            'ombd_id' => $this->ombd_id
        ];
    }

    public function isTitle(): bool
    {
        return $this->isTitle;
    }
}
