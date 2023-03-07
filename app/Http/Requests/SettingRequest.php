<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'company_name' => ['required','string'],
            'company_phone' => ['required','string'],
            'company_address' => ['required','string'],
            'email' => ['required','email'],
            'city' => ['required','string'],
            'facebook' => ['required','string'],
            'linkedin' => ['required','string'],
            'phone' => ['required','string'],
            'image' => 'nullable|image',
            'metadesc' => 'nullable',
            'metakeyword' => 'nullable',
            'ipan' => 'nullable',
            'rate' => 'nullable',
        ];
    }
}
