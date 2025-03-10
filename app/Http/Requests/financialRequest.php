<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class financialRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'category' => 'required|in:revenue,expense',
                'source' => 'required|in:Reservations,Services,other',
                'amount' => 'required|numeric',
                'total_amount' => 'required|numeric',
                'description' => 'nullable|string|max:255',
                'transaction_date' => 'required|date',
            ];
        }
        if ($this->isMethod('put') ||  $this->isMethod('patch')) {
            return [
                'category' => 'in:revenue,expense',
                'source' => 'in:Reservations,Services,other',
                'amount' => 'float',
                'total_amount' => 'float|max:25',
                'description' => 'nullable|string|max:255',
                'transaction_date' => 'date',
            ];
        }
    }
}
