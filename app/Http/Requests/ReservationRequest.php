<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            // 'user_id' => 'required|integer|exists:users,id',
            'guest_name' => 'required|string|max:25',
            'guest_email' => 'required|email |max:255 |string',
            'guest_phone' => 'required|max:10|string',
            'total_amount' => 'numeric',
            'note' => 'string|max:255',
            'Reservation_status' => 'required|in:CONFIRMED,CANCELLED,COMPLETED',
            'services_requested' => 'required|in:YES,NO',
            'payment_method' => 'required|in:CASH,CREDIT_CARD,BANK_TRANSFER',
            'payment_status' => 'required|in:PENDING,COMPLETED,FAILED,REFUNDED',
            'payment_reference' => 'nullable|string',
        ];
    }
}
