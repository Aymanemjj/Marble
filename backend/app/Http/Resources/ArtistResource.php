<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result =  [
            'firstname'=> $this->firstname,
            'lastname'=>$this->lastname,
            'date_of_birth'=> $this->date_of_birth,
            'date_of_death'=> $this->date_of_death,
            'main_medium'=> $this->main_medium,
            'picture'=> $this->picture,
            'banner'=> $this->banner,
            'biography'=> $this->biography,
        ];

        if($this->middlename)  $result['middlename'] = $this->middlename ;

        return $result;
    }
}
