<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullName' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
