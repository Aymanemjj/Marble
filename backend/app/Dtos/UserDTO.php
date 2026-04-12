<?php

namespace App\Dtos;

use App\Models\User;
use JsonSerializable;

class UserDTO implements JsonSerializable
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private string $firstname,
        private ?string $middlename,
        private string $lastname,
        private string $email,
        private ?string $date_of_birth,
        private ?string $main_medium
    ) {}




    public static function make(User $user): self
    {
        return new self(
            $user->firstname,
            $user->middlename ?? "None",
            $user->lastname,
            $user->email,
            $user->date_of_birth,
            $user->main_medium  ?? "None"
        );
    }

    public static function collection(array $users): array
    {
        $list = [];
        foreach ($users as $user) {
            $list[] = self::make($user);
        }
        return $list;
    }

    public function jsonSerialize(): array
    {
        return [
            'firstname'     => $this->firstname,
            'middlename'    => $this->middlename,
            'lastname'      => $this->lastname,
            'email'         => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'main_medium'   => $this->main_medium,
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
    public function getDateOfBirth(): string
    {
        return $this->date_of_birth;
    }
    public function getMainMedium(): ?string
    {
        return $this->main_medium;
    }
}
