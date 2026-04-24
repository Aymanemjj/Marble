<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->firstname,
            'middlename'=>$this->middlename,
            'lastname'=>$this->lastname,
            'email'=>$this->email,
            'main_medium'=> $this->main_medium,
        ];


    }
}
