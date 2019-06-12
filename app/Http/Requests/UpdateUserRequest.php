<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'estado' => 'nullable|string',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->route('usuario')->id)
            ],
            'dni' => [
                'required',
                Rule::unique('users')->ignore($this->route('usuario')->id),
                'digits:8'
            ]
        ];

        if($this->filled('password')){
            $rules['password'] = ['confirmed','min:6'];
        }

        return $rules;
    }
}
