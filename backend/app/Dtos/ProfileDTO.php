<?php

namespace App\Dtos;

use App\Models\Profile;

class ProfileDTO
{
    public function __construct(
        private string $picture,
        private string $banner,
        private string $biography,
        private int    $user_id,
    ) {}

    public static function make(Profile $profile): self
    {
        return new self(
            $profile->picture,
            $profile->banner,
            $profile->biography,
            $profile->user_id,
        );
    }

    public static function collection(array $profiles): array
    {
        $list = [];
        foreach ($profiles as $profile) {
            $list[] = self::make($profile);
        }
        return $list;
    }


    public function getPicture(): string
    {
        return $this->picture;
    }
    public function getBanner(): string
    {
        return $this->banner;
    }
    public function getBiography(): string
    {
        return $this->biography;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
