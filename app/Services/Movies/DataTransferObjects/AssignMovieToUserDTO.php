<?php

namespace App\Services\Movies\DataTransferObjects;

use App\Models\User;

class AssignMovieToUserDTO
{
    public function __construct(
        public readonly User $user,
        public readonly bool $isTitle,
        public readonly ?string $title,
        public readonly ?string $ombd_id,
    )
    {
    }

    public function toArray()
    {
        return [
            'isTitle' => $this->isTitle,
            'title' => $this->title,
            'ombd_id' => $this->ombd_id,
            'user' => $this->user
        ];
    }
}
