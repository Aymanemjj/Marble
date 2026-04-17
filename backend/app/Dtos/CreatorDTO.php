<?php

namespace App\Dtos;

use App\Interfaces\CreatorInterface;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use JsonSerializable;

class CreatorDTO implements JsonSerializable
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private int $id,
        private string $firstname,
        private ?string $middlename,
        private string $lastname,
        private ?string $date_of_birth,
        private ?string $date_of_death,
        private ?string $main_medium,
        private ?string $picture,
        private ?string $banner,
        private string $biography,
        private bool $administered,
    ) {}




    public static function make(CreatorInterface $creator): self
    {
        if ($creator instanceof Artist) {
            return new self(
                $creator->id,
                $creator->firstname,
                $creator->middlename ?? "None",
                $creator->lastname,
                $creator->date_of_birth ?? "None provided",
                $creator->date_of_death ?? 'Still alive',
                $creator->main_medium  ?? "None",
                $creator->picture ?? URL::to('/') . Storage::url('profiles/default.jpg'),
                $creator->banner ?? URL::to('/') . Storage::url('profiles/default.jpg'),
                $creator->biography ?? 'None provided',
                true
            );
        } else {
            return new self(
                $creator->id,
                $creator->firstname,
                $creator->middlename ?? "None",
                $creator->lastname,
                $creator->date_of_birth ?? "None provided",
                $creator->date_of_death ?? 'Still alive',
                $creator->main_medium  ?? "None",
                $creator->profile->picture ?? URL::to('/') . Storage::url('profiles/default.jpg'),
                $creator->profile->banner ?? URL::to('/') . Storage::url('profiles/default.jpg'),
                $creator->profile->biography ?? 'None provided',
                false
            );
        }
    }

    public static function collection($creators): array
    {
        $list = [];
        foreach ($creators as $creator) {
            $list[] = self::make($creator);
        }
        return $list;
    }

    public function jsonSerialize(): array
    {
        return  [
            'id' => $this->id,
            'firstname'     => $this->firstname,
            'middlename'    => $this->middlename,
            'lastname'      => $this->lastname,
            'date_of_birth' => $this->date_of_birth,
            'date_of_death' => $this->date_of_death,
            'main_medium'   => $this->main_medium,
            'administered' => $this->administered,
            'profile'=>[
                'picture'=>$this->picture,
                'banner'=> $this->banner,
                'biography' => $this->biography,
            ]
        ];
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
    public function getDateOfBirth(): string
    {
        return $this->date_of_birth;
    }
    public function getMainMedium(): ?string
    {
        return $this->main_medium;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of date_of_death
     */
    public function getDateOfDeath()
    {
        return $this->date_of_death;
    }
}
