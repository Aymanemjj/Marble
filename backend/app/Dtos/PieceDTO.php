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
        private int $id,
        private string $title,
        private string $story,
        private string $date,
        private string $path,
        private ?string $metadata,
        private ?array $tags,
        private bool $administered,
        private CreatorDTO $creator,
    ) {}

    public static function make(Piece $piece)
    {
        return new self(
            $piece->id,
            $piece->title,
            $piece->story,
            $piece->date,
            $piece->path,
            $piece->metadata,
            TagDTO::collection($piece->tags),
            $piece->administered,
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
            'id' => $this->id,
            'title'     => $this->title,
            'story'    => $this->story,
            'date'      => $this->date,
            'path'         => URL::to('/') . Storage::url($this->path),
            'metadata' => $this->metadata,
            'tags'  => $this->tags,
            'administered'=> $this->administered,
            'creator' => $this->creator
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
