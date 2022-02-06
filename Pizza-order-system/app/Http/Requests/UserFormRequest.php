<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'digits:11'],
            'address' => ['required', 'max:300'],
            'password' => ['required', 'min:8', 'max:24', 'same:confirmation'],
            'confirmation' => ['required']
        ];
    }
}
