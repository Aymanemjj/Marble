<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreArtistRequest extends FormRequest
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
            'firstname'    => 'required|string|max:255',
            'middlename'   => 'sometimes|string|max:255',
            'lastname'     => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'date_of_death' => 'sometimes|string|max:255',
            'main_medium'  => 'required|string|max:255',
            'biography'    => 'required|string',
            'picture'      => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'banner'       => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:20480',
        ];
    }

    public function message()
    {
        return [
            'firstname.required' => 'Firstname is a required input.',
            'firstname.max' => 'Firstname needs to be less than 255 charachters.',

            'middlename.max' => 'Middlename needs to be less than 255 charachters.',

            'lastname.required' => 'Lastname is a required input.',
            'lastname.max' => 'Lastname needs to be less than 255 charachters.',

            'date_of_birth.required' => 'Date of birth is required',
            'date_of_death.required' => 'Date of death is required',


            'main_medium.max' => 'Main medium needs to be less than 255 charachters.',
            'main_medium.required' => 'Main medium is a required input.',

            'picture.required' => 'A picture is required.',
            'picture.size' => 'The picture needs to be less than 20 megabytes.',
            'picture.mimes' => 'File must be an image or video (jpg, jpeg, png, gif, webp)',


            'banner.size' => 'The banner needs to be less than 20 megabytes.',
            'banner.required' => 'A banner is required.',
            'banner.mimes' => 'File must be an image or video (jpg, jpeg, png, gif, webp)',


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
