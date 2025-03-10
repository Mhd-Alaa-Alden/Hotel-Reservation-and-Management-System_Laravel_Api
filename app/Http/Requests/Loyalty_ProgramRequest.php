<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Loyalty_ProgramRequest extends FormRequest
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
                'LevelName' => 'required|in:Bronze,Silver,Gold',
                'condition_type' => 'required|in:points,spending,visits',
                'condition_value' => 'nullable|integer|min:1|max:1000',
                'additional_services' => 'nullable|string|max:25',
                'discount_rate' => 'required|integer|min:0|max:100',
            ];
        }
        if ($this->isMethod('put') ||  $this->isMethod('patch')) {
            return [
                'LevelName' => 'sometimes|in:Bronze,Silver,Gold',
                'condition_type' => 'sometimes|in:points,spending,visits',
                'condition_value' => 'sometimes|integer|min:1|max:1000',
                'additional_services' => 'sometimes|string|max:25',
                'discount_rate' => 'sometimes|integer|min:0|max:100',
            ];
        }
    }
}
