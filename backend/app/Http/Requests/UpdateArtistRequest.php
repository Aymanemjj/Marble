<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname'     => 'sometimes|string|max:255',
            'middlename'    => 'sometimes|string|max:255',
            'lastname'      => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|string|max:255',
            'date_of_death' => 'sometimes|string|max:255',
            'main_medium'   => 'sometimes|string|max:255',
            'biography'     => 'sometimes|string',
            'picture'       => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'banner'        => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:20480',
            'fav_piece_id_1' => ['sometimes', Rule::exists('pieces', 'id')->where('artist_id', $this->input('artist_id'))],
            'fav_piece_id_2' => ['sometimes', Rule::exists('pieces', 'id')->where('artist_id', $this->input('artist_id'))],
            'artist_id'     => 'sometimes|exists:artists,id',
        ];
    }

    public function message()
    {
        return [
            'firstname.max' => 'Firstname needs to be less than 255 charachters.',

            'middlename.max' => 'Middlename needs to be less than 255 charachters.',

            'lastname.max' => 'Lastname needs to be less than 255 charachters.',



            'main_medium.max' => 'Main medium needs to be less than 255 charachters.',

            'picture.size' => 'The picture needs to be less than 20 megabytes.',

            'banner.size' => 'The banner needs to be less than 20 megabytes.',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            "success" => false,
            'message' => 'Erreur de validation',
            'error' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
