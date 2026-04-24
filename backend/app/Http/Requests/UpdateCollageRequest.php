<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCollageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'public'      => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string'    => 'Title must be a string.',
            'title.max'       => 'Title cannot exceed 255 characters.',
            'public.boolean'  => 'Public must be true or false.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            "success" => false,
            'message' => 'Erreur de validation',
            'error'   => $errors->messages(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
