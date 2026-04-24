<?php

namespace App\Dtos;

use App\Models\Collage;
use Illuminate\Support\Facades\Auth;
use JsonSerializable;

class CollageDTO implements JsonSerializable
{
    public function __construct(
        private string $title,
        private string $description,
        private bool   $public,
        private ?UserDTO $owner,
        private ?array $pieces
    ) {}

    public static function make(Collage $collage): self
    {
        return new self(
            $collage->title,
            $collage->description,
            $collage->public,
            UserDTO::make($collage->owner),
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
        $return = [
            'title'     => $this->title,
            'description'    => $this->description,
            'public'      => $this->public,
            'owner'         => [
                'firstname'     => $this->owner->getFirstname(),
                'middlename'    => $this->owner->getMiddlename(),
                'lastname'      => $this->owner->getLastname(),
                'email'         => $this->owner->getEmail(),
            ],
            'pieces'=>[]
        ];

        foreach ($this->pieces as $piece) {
            $return['pieces'] = $piece->jsonSerialize();
        }
        return $return;
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
