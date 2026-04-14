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
            'firstname' => 'required|max:255|string',
            'middlename' => 'sometimes|max:255|string',
            'lastname' => 'max:255|required|string',
            'date_of_birth' => 'max:255|required|string',
            'date_of_death' => 'max:255|required|string',
            'main_medium' => 'max:255|required|string',
            'biography' => 'string|required',
            'picture' => 'file|size:20480|mimes:jpg,jpeg,png,gif,webp|required|',
            'banner' => 'file|required|mimes:jpg,jpeg,png,gif,webp|size:20480'
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
