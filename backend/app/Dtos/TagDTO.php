<?php

namespace App\Dtos;

use App\Models\Tag;

class TagDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private string $name,
        private string $description,
    ) {}


    public static function make(Tag $tag): self
    {
        return new self(
            $tag->name,
            $tag->description
        );
    }

    public static function collection(array $tags): array
    {
        $list = [];
        foreach ($tags as $tag) {
            $list[] = self::make($tag);
        }
        return $list;
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
