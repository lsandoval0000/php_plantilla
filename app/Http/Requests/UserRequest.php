<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];

        if(in_array($this->method(),['POST','CREATE'])){
            $rules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dni' => 'required|string|digits:8|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'estado' => 'nullable|string'
            ];
        }
        if(in_array($this->method(),['PUT','PATCH','UPDATE'])){
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
        }
        return $rules;
    }
}
