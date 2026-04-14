<?php

namespace App\Dtos;

use App\Models\Artist;
use Carbon\Carbon;

class ArtistDTO
{
    public function __construct(
        private string  $firstname,
        private ?string $middlename,
        private string  $lastname,
        private Carbon  $date_of_birth,
        private Carbon  $date_of_death,
        private string  $main_medium,
        private string  $picture,
        private string  $banner,
        private string  $biography,
    ) {}

    public static function make(Artist $artist): self
    {
        return new self(
            $artist->firstname,
            $artist->middlename ?? null,
            $artist->lastname,
            Carbon::parse($artist->date_of_birth),
            Carbon::parse($artist->date_of_death),
            $artist->main_medium,
            $artist->picture,
            $artist->banner,
            $artist->biography,
        );
    }

    public static function collection($artists): array
    {
        $list = [];
        foreach ($artists as $artist) {
            $list[] = self::make($artist);
        }
        return $list;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function getDateOfBirth(): Carbon
    {
        return $this->date_of_birth;
    }
    public function getDateOfDeath(): Carbon
    {
        return $this->date_of_death;
    }
    public function getMainMedium(): string
    {
        return $this->main_medium;
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
}
