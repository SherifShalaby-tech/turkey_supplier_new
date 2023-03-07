<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'country' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'min:6',
            'trade_role' => 'required',
            'full_name' => 'required',
            'phone' => 'nullable',
            'phone2' => 'required',
            'agree' => 'required',
        ];
    }
}
