<?php

namespace App\Dtos;

use App\Models\Collage;

class CollageDTO
{
    public function __construct(
        private string $title,
        private string $description,
        private bool   $public,
        private int    $user_id,
    ) {}

    public static function make(Collage $collage): self
    {
        return new self(
            $collage->title,
            $collage->description,
            $collage->public,
            $collage->user_id,
        );
    }

    public static function collection(array $collages): array
    {
        $list = [];
        foreach ($collages as $collage) {
            $list[] = self::make($collage);
        }
        return $list;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getPublic(): bool
    {
        return $this->public;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
