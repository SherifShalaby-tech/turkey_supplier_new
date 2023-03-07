<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilepassRequest extends FormRequest
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
                    'current_password'       => 'required|min:6',
                    'password'               => 'required|min:6|different:current_password',
                    'password_confirmation'  => 'required|min:6|same:password'
                ];
            }
            default: break;
        }
    }
}
