<?php

namespace App\Http\Requests\Website\shipmentOrder;

use Illuminate\Foundation\Http\FormRequest;

class add_order extends FormRequest
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
            // 'shipment_services_id' => 'required|exists:shipment_services,id',
            // 'user_id' => 'required|exists:users,id'
        ];
    }
}
