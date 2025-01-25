<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'type' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'event_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'The ticket type is required.',
            'price.required' => 'The ticket price is required.',
            'quantity.required' => 'The ticket quantity is required.',
            'event_id.required' => 'The event ID is required.',
        ];
    }
}
