<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class UpdateRiderRequest extends FormRequest
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
        $id = explode("/", $this->getRequestUri())[3];
        return [
            'name' => 'required',
            'phone' => 'required|min:11',
            'email' => ['required', 'email', Rule::unique('riders')->ignore($id)],
            'address' => 'required',
        ];
    }
}
