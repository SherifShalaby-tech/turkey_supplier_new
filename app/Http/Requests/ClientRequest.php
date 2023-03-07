<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name'    => 'required|string',
                    // 'description' => 'nullable',
                    // 'plan_id' => ['required','exists:plans,id'],
                    'email'   => 'required|email|max:255|unique:companies',
                    // 'cod' => 'nullable',
                    'phone'   => 'required',
                    // 'phone1'   => 'nullable',
                    // 'phone2'   => 'nullable',
                    // 'phone3'   => 'nullable',
                    'country' => 'required|string',
                    'password' => 'required|confirmed|min:6|max:10',
                    // 'images' => 'required',
                    // 'images.*' => 'mimes:jpg,jpeg,png,gif|max:3000',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string',
                    // 'description' => 'nullable',
                    // 'plan_id' => ['required','exists:plans,id'],
                    // 'email' => ['required','email'],
                    // 'email'  => 'required|email|max:255|unique:companies,email,'.$this->route()->company->id,
                    // 'cod' => 'nullable',
                    'phone' => 'nullable',
                    // 'phone1'   => 'nullable',
                    // 'phone2'   => 'nullable',
                    // 'phone3'   => 'nullable',
                    'country' => 'required|string',
                    'password' => 'nullable|confirmed|min:6|max:10',
                    // 'images' => 'nullable',
                    // 'images.*' => 'mimes:jpg,jpeg,png,gif|max:3000',
                ];
            }
            default: break;
        }
    }
}
