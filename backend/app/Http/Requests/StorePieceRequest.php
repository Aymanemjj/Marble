<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StorePieceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $rules =  [
            'title'        => 'required|string',
            'story'        => 'required|string',
            'date'         => 'required|date',
            'path'         => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:20480',
            'metadata'     => 'sometimes|string',
            'tags'   => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];

        if (Auth::user()->isAdmin()) $rules['artist'] = 'required|exists:artists,id';

        return  $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.required'        => 'A title is required',
            'title.string'          => 'Title must be a string',
            'story.required'        => 'A story is required',
            'story.string'          => 'Story must be a string',
            'date.required'         => 'A date is required',
            'date.date'             => 'Date must be a valid date',
            'path.required'         => 'A file is required',
            'path.file'             => 'Path must be a file',
            'path.mimes'            => 'File must be an image or video (jpg, jpeg, png, gif, webp)',
            'path.max'              => 'File size must not exceed 20MB',
            'metadata.string'       => 'Metadata must be a string',
            'tags.*.exists' => 'One or more selected tags do not exist.',
        ];

        if (Auth::user()->isAdmin()) {
            $messages['artist.required'] = 'Artist field is requierd';
            $messages['artist.exists'] = 'Artist doesn\'t exists';
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
