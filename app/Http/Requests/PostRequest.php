<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'title cannot be empty',
            'title.string' => 'title must be alphanumeric',
            'title.max' => 'title cannot exceed 255 letters',
            'content.required' => 'content cannot be empty',
            'content.string' => 'content must be alphanumeric',
        ];
    }
}
