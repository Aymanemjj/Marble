<?php

namespace App\Dtos;

use App\Models\Piece;
use Carbon\Carbon;

class PieceDTO
{
    public function __construct(
        private string $title,
        private string $story,
        private Carbon $date,
        private string $path,
        private string $metadata,
        private bool   $administered,
    ) {}

    public static function make(Piece $piece): self
    {
        return new self(
            $piece->title,
            $piece->story,
            Carbon::parse($piece->date),
            $piece->path,
            $piece->metadata,
            $piece->administered,
        );
    }

    public static function collection(array $pieces): array
    {
        $list = [];
        foreach ($pieces as $piece) {
            $list[] = self::make($piece);
        }
        return $list;
    }


    public function getTitle(): string
    {
        return $this->title;
    }
    public function getStory(): string
    {
        return $this->story;
    }
    public function getDate(): Carbon
    {
        return $this->date;
    }
    public function getPath(): string
    {
        return $this->path;
    }
    public function getMetadata(): string
    {
        return $this->metadata;
    }
    public function getAdministered(): bool
    {
        return $this->administered;
    }
}
