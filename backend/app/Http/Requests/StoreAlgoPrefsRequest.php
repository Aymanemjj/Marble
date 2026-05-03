<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAlgoPrefsRequest extends FormRequest
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
            'piece_id' => 'required|exists:pieces,id',
            'duration' => 'required|integer|min:3'
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
