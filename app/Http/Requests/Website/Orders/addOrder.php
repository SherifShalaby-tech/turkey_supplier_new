<?php

namespace App\Http\Requests\Website\Orders;

use Illuminate\Foundation\Http\FormRequest;

class addOrder extends FormRequest
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
            'user_id' => 'required|exists:companies,id',
            'cart_id' => 'required|exists:carts,id',
            'products' => 'required|array|min:1'
        ];
    }
}
