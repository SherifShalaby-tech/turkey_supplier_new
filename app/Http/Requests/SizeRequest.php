<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
{

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
                    'sizeName' => 'required|max:255|unique:sizes',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'sizeName' => 'required|max:255|unique:sizes,sizeName,'.$this->route()->size->id,
                ];
            }
            default: break;
        }
    }
}
