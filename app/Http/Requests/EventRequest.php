<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        return [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'venue_id' => 'required|exists:venues,id',
            'thumbnail' => 'sometimes'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'The event name is required.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'description.required' => 'The event description is required.',
            'start_time.required' => 'The start time is required.',
            'start_time.date' => 'The start time must be a valid date.',
            'end_time.required' => 'The end time is required.',
            'end_time.date' => 'The end time must be a valid date.',
            'end_time.after' => 'The end time must be after the start time.',
            'venue_id.required' => 'The venue is required.',
            'venue_id.exists' => 'The selected venue is invalid.',
            'thumbnail.required' => 'The event thumbnail is required.',
            'thumbnail.image' => 'The thumbnail must be an image.',
        ];
    }

}
