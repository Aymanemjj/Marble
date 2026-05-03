<?php

namespace App\Dtos;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use JsonSerializable;

class UserDTO implements JsonSerializable
{
    public function __construct(
        private int $id,
        private string  $firstname,
        private ?string $middlename,
        private string  $lastname,
        private string  $email,
        private ?string $date_of_birth,
        private ?string $main_medium,
        private ?string $picture,
        private ?string $banner,
        private ?string  $biography,
        private ?PieceDTO $fav_piece_1,
        private ?PieceDTO $fav_piece_2,
        private string $role,
    ) {}

    public static function make(User $user): self
    {
        $defaultImage = URL::to('/') . Storage::url('profiles/default.jpg');

        return new self(
            $user->id,
            $user->firstname,
            $user->middlename ?? 'None',
            $user->lastname,
            $user->email,
            $user->date_of_birth,
            $user->main_medium   ?? 'None',
            $user->profile->picture  ?? $defaultImage,
            $user->profile->banner   ?? $defaultImage,
            $user->profile->biography ?? 'None provided',

            $user->profile->favPiece1 ? PieceDTO::make($user->profile->favPiece1) : null,

            $user->profile->favPiece2 ? PieceDTO::make($user->profile->favPiece2) : null,
            $user->role
        );
    }

    public static function collection(array $users): array
    {
        return array_map(fn(User $user) => self::make($user), $users);
    }

    public function jsonSerialize(): array
    {
        return  [
            'id' => $this->id,
            'role'=>$this->role,
            'firstname'     => $this->firstname,
            'middlename'    => $this->middlename,
            'lastname'      => $this->lastname,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'main_medium'   => $this->main_medium,
            'profile' => [
                'picture' => URL::to('/') . Storage::url($this->picture),
                'banner' => URL::to('/') . Storage::url($this->banner),
                'biography' => $this->biography,
                'fav_piece_1' => $this->fav_piece_1,
                'fav_piece_2' => $this->fav_piece_2,
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
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getDateOfBirth(): ?string
    {
        return $this->date_of_birth;
    }
    public function getMainMedium(): ?string
    {
        return $this->main_medium;
    }
    public function getPfp(): ?string
    {
        return $this->pfp;
    }
    public function getBanner(): ?string
    {
        return $this->banner;
    }
    public function getBiography(): string
    {
        return $this->biography;
    }
}
