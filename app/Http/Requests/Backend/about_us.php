<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class about_us extends FormRequest
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
            'about_us' => 'required',
            'services' => 'required',
            'shipping_products' => 'required',
            'mediation' => 'required',
            'images' => 'nullable|array|image|mimes:jpg,jpeg,png,gif|max:3000'
        ];
    }
}
