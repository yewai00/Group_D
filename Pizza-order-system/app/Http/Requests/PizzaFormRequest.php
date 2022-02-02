<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PizzaFormRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'image|mimes:png,jpeg|max:2048',
            'category_id' => 'required',
            'price' => 'required',
            'buy_one_get_one' => 'required',
            'description' => 'required|max:1000'
        ];
    }
}
