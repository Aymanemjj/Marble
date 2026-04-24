<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'firstname' => 'sometimes|max:255|string',
            'middlename' => 'sometimes|max:255|string',
            'lastname' => 'max:255|sometimes|string',
            'date_of_birth' => 'max:255|sometimes|string',
            'date_of_death' => 'max:255|sometimes|string',
            'main_medium' => 'max:255|sometimes|string',
            'biography' => 'string|sometimes',
            'picture' => 'file|size:20480|sometimes|',
            'banner'=> 'file|sometimes|size:20480'
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
