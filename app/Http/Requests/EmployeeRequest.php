<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        if ($this->isMethod('post')) {

            return [
                'name' => 'required|string|max:25',
                'email' => 'required|email |max:255 |string|unique:employees',
                'password' => 'required|string|confirmed|min:8',
                'role' => 'required|string|exists:roles,name|max:10',
                'salary' => 'required|max:10|string',
                'contactinfo' => 'required|max:255|string',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'name'       => 'sometimes|string|max:255',
                'email'      => 'sometimes|email|unique:employees,email,' . $this->route('employee'),
                'password'   => 'nullable|string|confirmed|min:8',
                'role' => 'required|string|exists:roles,name|max:10',
                'salary'     => 'sometimes|numeric|min:0',
                'contactinfo' => 'sometimes|string|max:255',
            ];
        }
    }
}
