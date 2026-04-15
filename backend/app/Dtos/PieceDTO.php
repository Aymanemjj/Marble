<?php

namespace App\Dtos;

use App\Models\Piece;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use JsonSerializable;

class PieceDTO implements JsonSerializable
{
    public function __construct(
        private string $title,
        private string $story,
        private string $date,
        private string $path,
        private string $metadata,
        private ?array $tags,
        private ?CreatorDTO $creator,
    ) {}

    public static function make(Piece $piece): self
    {
        return new self(
            $piece->title,
            $piece->story,
            $piece->date,
            $piece->path,
            $piece->metadata,
            $piece->tags->pluck('name')->toArray(),
            CreatorDTO::make($piece->owner)
        );
    }

    public static function collection($pieces): array
    {
        $list = [];
        foreach ($pieces as $piece) {
            $list[] = self::make($piece);
        }
        return $list;
    }

    public function jsonSerialize(): array
    {
        return [
            'title'     => $this->title,
            'story'    => $this->story,
            'date'      => $this->date,
            'path'         => URL::to('/') . Storage::url($this->path),
            'metadata' => $this->metadata,
            'tags'  => $this->tags,
            'creator' => [
                'id'=> $this->creator->getId(),
                'firstname'     => $this->creator->getFirstname(),
                'middlename'    => $this->creator->getMiddlename(),
                'lastname'      => $this->creator->getLastname(),
                'date_of_birth' => $this->creator->getDateOfBirth(),
                'date_of_death'=> $this->creator->getDateOfDeath(),
                'main_medium' => $this->creator->getMainMedium(),

            ]
        ];
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getStory(): string
    {
        return $this->story;
    }
    public function getDate(): string
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
    public function getTags(): array
    {
        return $this->tags;
    }
}
