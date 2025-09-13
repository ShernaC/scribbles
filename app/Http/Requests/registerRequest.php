<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
        'name.required' => 'Name cannot be empty',
        'name.string' => 'Name must be a string',
        'name.max' => 'Name cannot exceed 255 characters',
        'email.required' => 'Email cannot be empty',
        'email.email' => 'Please enter a valid email address',
        'email.unique' => 'This email is already registered',
        'password.required' => 'Password cannot be empty',
        'password.string' => 'Password must be a string',
        'password.min' => 'Password must be at least 8 characters long',
        'password.confirmed' => 'Passwords do not match'
        ];
    }
}
