<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;

class RegisterRequest extends FormRequest
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
        $date = Carbon::today()->subYears(6)->toDateString();

        return [
            'firstname' => 'required|max:255|string',
            'middlename' => 'sometimes|max:255|string',
            'lastname' => 'required|max:255|string',
            'date_of_birth' => "sometimes|before:$date",
            'email' => 'required|max:255|string|unique:users,email|email',
            'password' => 'required|max:255|confirmed',
            "main_medium" => "max:255|string|sometimes"
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

            'email.unique' => 'This email is already used',
            'email.required' => 'Email is a required input.',
            'email.max' => 'Email needs to be less than 255 charachters.',

            'password.required' => 'Password is a required input.',
            'password.max' => 'Password needs to be less than 255 charachters.',

            'date_of_birth.before' => 'Your too young',

            'main_medium.max' => 'Main medium needs to be less than 255 charachters.',

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
