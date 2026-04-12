<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePieceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'sometimes|string',
            'story'        => 'sometimes|string',
            'date'         => 'sometimes|date',
            'path'         => 'sometimes|file|mimes:jpg,jpeg,png,gif,webp|max:20480',
            'metadata'     => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string'         => 'Title must be a string',
            'story.string'         => 'Story must be a string',
            'date.date'            => 'Date must be a valid date',
            'path.file'            => 'Path must be a file',
            'path.mimes'           => 'File must be an image or video (jpg, jpeg, png, gif, webp)',
            'path.max'             => 'File size must not exceed 20MB',
            'metadata.string'      => 'Metadata must be a string',
        ];
    }
}
