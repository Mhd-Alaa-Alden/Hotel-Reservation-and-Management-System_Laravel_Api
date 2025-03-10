<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'servicename' => 'required|string|max:25',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'Services_status' => 'required|in:active,inactive',

            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
