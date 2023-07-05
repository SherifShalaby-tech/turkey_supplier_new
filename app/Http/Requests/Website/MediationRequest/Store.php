<?php

namespace App\Http\Requests\Website\MediationRequest;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'name' => 'required|string',
            'company_id' => 'required',
            'company_name' => 'nullable',
            'phone_number' => 'nullable',
            'country' => 'nullable',
            'product_id' => 'required',
            'qty' => 'nullable',
            'supply_period' => 'nullable'
        ];
    }
}
