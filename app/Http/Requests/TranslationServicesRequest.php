<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationServicesRequest extends FormRequest
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
                    'name'      => 'required',
                    'country_code' => 'nullable',
                    'phone_number' => 'required',
                    'language' => 'required',
                    'company_id' => 'nullable',
                    'product_id' => 'nullable',
                    'notes' => 'nullable',
                    'email' => 'required|email'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // 'colorName' => 'required|max:255|unique:colors,colorName,'.$this->route()->color->id,
                    'name'      => 'required',
                    'country_code' => 'nullable',
                    'phone' => 'required',
                    'language' => 'nullable',
                    'company_id' => 'nullable',
                    'product_id' => 'nullable',
                    'notes' => 'nullable',
                    'email' => 'required|email'
                ];
            }
            default: break;
        }
    }
}
