<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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

            'user_id' => 'required|integer|exists:users,id',
            'room_id' => 'required|integer|exists:rooms,id',
            'rating' => 'nullable|integer|min:0|max:4',
            'review' => 'nullable|string|max:255',
        ];
    }
}
