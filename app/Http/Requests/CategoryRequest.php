<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['slug'] = 'required|unique:categories,slug,' . $this->route('category')->id;
        }

        return $rules;
    }

}
