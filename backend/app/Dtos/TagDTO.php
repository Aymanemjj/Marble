<?php

namespace App\Dtos;

use App\Models\Tag;
use JsonSerializable;

class TagDTO implements JsonSerializable
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
    ) {}


    public static function make(Tag $tag): self
    {
        return new self(
            $tag->id,
            $tag->name,
            $tag->description
        );
    }

    public static function collection($tags): array
    {
        $list = [];
        foreach ($tags as $tag) {
            $list[] = self::make($tag);
        }
        return $list;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'description' => $this->description
        ];
    }


    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
}
