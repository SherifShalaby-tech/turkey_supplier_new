<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
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
                    'email'         => 'required|email|unique:admins',
                    'phone'         => 'required|numeric|unique:admins',
                    'password'      => 'required|confirmed|min:6|max:10',
                    'permissions'   => 'required|min:1',
                    // 'type'          => 'required|in:admin,employee'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'          => 'required',
                    'email'         => 'required|email|unique:admins,email,'.$this->route()->admin->id,
                    'phone'         => 'required|numeric|unique:admins,phone,'.$this->route()->admin->id,
                    'password'      => 'nullable|confirmed|min:6|max:10',
                    'permissions'   => 'required|min:1',
                    // 'type'          => 'required|in:admin,employee'
                ];
            }
            default: break;
        }
    }
}
