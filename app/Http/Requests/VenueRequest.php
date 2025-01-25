<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('admin');
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:venues,name',
            'address' => 'required|string|max:500',
        ];
    }

    /**
     * Get custom error messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The venue name is required.',
            'name.string' => 'The venue name must be a valid string.',
            'name.unique' => 'The venue name is unique.',
            'name.max' => 'The venue name must not exceed 255 characters.',
            'address.required' => 'The venue address is required.',
            'address.string' => 'The venue address must be a valid string.',
            'address.max' => 'The venue address must not exceed 500 characters.',
        ];
    }
}
