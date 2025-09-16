<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class uploadRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,avif|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'image uploaded must be an image',
            'image.mimes' => 'image must be in jpeg/png/jpg/gif/svg format',
            'image.max' => 'image cannot exceed 2048 kb',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        Log::error('Validation failed:', $validator->errors()->toArray());
        
        parent::failedValidation($validator);
    }
}
