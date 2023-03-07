<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ClerkRequest extends FormRequest
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
                    'name'          => 'required',
                    'email'         => 'required|email|unique:clerks',
                    'phone'         => 'required|numeric|unique:clerks',
                    'status'        => 'required',
                    'password'      => 'required|min:6',
                    'company_id'    => 'required',
                    'permissions'   => 'required|min:1',
                    // 'image'         => 'nullable|mimes:jpg,jpeg,png,svg'

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'          => 'required',
                    'email'         => 'required|email|unique:clerks,email,'.$this->route()->clerk->id,
                    'phone'         => 'required|numeric|unique:clerks,phone,'.$this->route()->clerk->id,
                    'status'        => 'required',
                    'password'      => 'nullable|min:6',
                    'company_id'    => 'required',
                    'permissions'   => 'required|min:1',
                    // 'image'         => 'nullable|mimes:jpg,jpeg,png,svg|max:20000'

                ];
            }
            default: break;
        }
    }
}
