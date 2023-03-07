<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatecompanyRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    // 'current_password'  =>'required',
                    // 'password'          => 'required|min:6|different:current_password',
                    // 'password_confirmation'  => 'required|min:6|same:password'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string',
                    'description' => 'nullable',
                    'plan_id' => ['required','exists:plans,id'],
                    // 'email' => ['required','email'],
                    // 'email'  => 'required|email|max:255|unique:companies,email,'.$this->route()->company->id,
                    'cod' => 'nullable',
                    'phone' => 'nullable',
                    'phone1'   => 'nullable',
                    'phone2'   => 'nullable',
                    'phone3'   => 'nullable',
                    'country' => 'required|string',
                    // 'password' => 'nullable|confirmed|min:6|max:10',
                    'images' => 'nullable',
                    'images.*' => 'mimes:jpg,jpeg,png,gif|max:3000',
                ];
            }
            default: break;
        }
    }
}
