<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'somtimes|integer|exists:categorys,id',
            'room_number' => 'somtimes|integer',
            'capacity' => 'somtimes|integer',
            'floor' => 'somtimes|integer',
            'bathroom' => 'somtimes|integer',
            'price' => 'somtimes|numeric',
            'images' => 'somtimes|image|mimes:png,jpg,jpeg,gif|max:2048 ',
            'description' => 'somtimes|string|max:255',
        ];
    }
}
