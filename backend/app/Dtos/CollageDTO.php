<?php

namespace App\Dtos;

use App\Models\Collage;
use Illuminate\Support\Facades\Auth;
use JsonSerializable;

class CollageDTO implements JsonSerializable
{
    public function __construct(
        private int    $id,
        private string $title,
        private string $description,
        private bool   $public,
        private bool   $administered,
        private ?CreatorDTO $owner,
        private ?array $pieces
    ) {}

    public static function make(Collage $collage): self
    {
        return new self(
            $collage->id,
            $collage->title,
            $collage->description,
            $collage->public,
            $collage->administered,
            CreatorDTO::make($collage->owner),
            PieceDTO::collection($collage->pieces)
        );
    }


    public static function collection($collages): array
    {
        $list = [];
        foreach ($collages as $collage) {
            $list[] = self::make($collage);
        }
        return $list;
    }



    public function jsonSerialize(): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'public'      => $this->public,
            'administered' => $this->administered,
            'creator'     => $this->owner,
            'pieces'      => $this->pieces,
        ];
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
    /*     public function getUserId(): int
    {
        return $this->user_id;
    } */
}
