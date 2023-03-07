<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadtimeRequest extends FormRequest
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
                    'qty' => 'required',
                    'price' => 'required',
                    'days' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'qty' => 'required',
                    'price' => 'required',
                    'days' => 'required',
                ];
            }
            default: break;
        }
    }
}
