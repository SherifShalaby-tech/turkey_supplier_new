<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class contact_supplier extends FormRequest
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
            // 'supplier_id' => 'required|exists:companies,id',
            // 'user_id'     => 'required|exists:companies,id',
            // 'product_id'  => 'required|exists:products,id',
            'message'     => 'required',
            'address'     => 'nullable',
            'subject'     => 'required',
            'file'        => 'nullable|file|mimes:pdf,jpeg,png,jpg',
        ];
    }
}
