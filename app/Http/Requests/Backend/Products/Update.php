<?php

namespace App\Http\Requests\Backend\Products;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'id' => 'required|exists:products,id',
            'name' => 'required|string',
            // 'image' => 'array|min:1',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'video_description' => 'nullable',
            'price' => 'required|numeric',
            'company_id' => 'required|exists:companies,id',
            'Packaging' => 'nullable',
            'Supply_Ability' => 'nullable',
            'Place_Origin' => 'nullable',
            'weight' => 'nullable',
            'class_list.*.colorName'=>'nullable',
            'class_list.*.sizeName'=>'nullable',
            'class_list.*.leadtime_qty'=>'nullable',
            'class_list.*.leadtime_price'=>'nullable',
            'class_list.*.days'=>'nullable|numeric',
            'images' => 'nullable|array|min:1',
//            'images.*' => '',
        ];
    }
}
