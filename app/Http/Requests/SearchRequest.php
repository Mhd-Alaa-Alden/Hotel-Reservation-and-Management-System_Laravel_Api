<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule as ValidationRule;

class SearchRequest extends FormRequest
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
            'price' => 'numeric',
            'name' => 'string',
            'role' => 'string',
            'categorie_id' => 'integer',
            'date' => 'date',
            'date_from' => 'date',
            'date_to' => 'date',
            'sortby' => ValidationRule::in(['price']),
            'sortorder' => ValidationRule::in(['asc', 'desc']),
        ];
    }
    public function messages(): array
    {
        return [
            'price' => "The 'price' parameter accepts only 'integer' Value",
            'name' => "The 'name' parameter accepts only 'string' Value",
            'role' => "The 'role' parameter accepts only 'string' Value",
            'categorie_id' => "The 'categorie_id' parameter accepts only 'integer' Value",
            'sortby' => "The 'sortby' parameter accepts only 'price' Value",
            'sortorder' => "The 'sortorder' parameter accepts only 'asc or desc' Value",
        ];
    }
}
