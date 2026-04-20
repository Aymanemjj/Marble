<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdatePieceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title'    => 'sometimes|string',
            'story'    => 'sometimes|string',
            'date'     => 'sometimes|date',
            'path'     => 'sometimes|file|mimes:jpg,jpeg,png,gif,webp|max:20480',
            'metadata' => 'sometimes|string',
            'tags'     => 'sometimes|nullable|array',
            'tags.*'   => 'exists:tags,id',
        ];

        if (Auth::user()->isAdmin()) $rules['artist'] = 'sometimes|exists:artists,id';

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.string'    => 'Title must be a string',
            'story.string'    => 'Story must be a string',
            'date.date'       => 'Date must be a valid date',
            'path.file'       => 'Path must be a file',
            'path.mimes'      => 'File must be an image (jpg, jpeg, png, gif, webp)',
            'path.max'        => 'File size must not exceed 20MB',
            'metadata.string' => 'Metadata must be a string',
            'tags.*.exists'   => 'One or more selected tags do not exist.',
        ];

        if (Auth::user()->isAdmin()) {
            $messages['artist.exists'] = 'Artist doesn\'t exist';
        }

        return $messages;
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
