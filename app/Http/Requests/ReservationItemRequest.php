<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationItemRequest extends FormRequest
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

    public function rules()
    {
        return [
            'reservation_id' => 'required|exists:reservations,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'children_count' => 'nullable|integer|min:0',
            'adults_count' => 'required|integer|min:1',
            'number_of_nights' => 'nullable|integer|min:1',
            'room_price' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ];
    }
}
