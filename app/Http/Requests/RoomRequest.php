<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categorys,id',
            'room_number' => 'required|integer',
            'capacity' => 'required|integer',
            'floor' => 'required|integer',
            'bathroom' => 'required|integer',
            'price' => 'required|numeric',
            'images' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048 ',
            'description' => 'required|string|max:255',
        ];
    }
}
