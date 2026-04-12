<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePieceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string',
            'story'        => 'required|string',
            'date'         => 'required|date',
            'path'         => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:20480',
            'metadata'     => 'sometimes|string',
            'tags'   => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
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
    }
}
