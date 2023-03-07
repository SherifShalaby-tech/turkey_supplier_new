<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
                    'colorName' => 'required|max:255|unique:colors',
                    'colorCode' => 'nullable',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'colorName' => 'required|max:255|unique:colors,colorName,'.$this->route()->color->id,
                    'colorCode' => 'nullable',
                ];
            }
            default: break;
        }
    }
}
