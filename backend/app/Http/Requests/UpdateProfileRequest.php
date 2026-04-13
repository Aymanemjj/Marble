<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'picture' => 'sometimes|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'banner' => 'sometimes|file|mimes:jpg,jpeg,png,gif,webp|max:20480',
            'biography' => 'sometimes|string',
        ];
    }


    public function messages(): array
    {
        return [
            'picture.file'     => 'The profile picture must be a valid file.',
            'picture.mimes'    => 'The profile picture must be a JPG, PNG, GIF, or WebP image.',
            'picture.max'      => 'The profile picture must not exceed 5MB.',

            'banner.file'      => 'The banner must be a valid file.',
            'banner.mimes'     => 'The banner must be a JPG, PNG, GIF, or WebP image.',
            'banner.max'       => 'The banner must not exceed 20MB.',

            'biography.string' => 'The biography must be a valid text string.',
        ];
    }
}
