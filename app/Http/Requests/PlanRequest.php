<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'title' => ['required','string','max:255'],
            'character_count' => ['required','integer'],
            'company_picture_count' => ['required','integer'],
            'product_count' => ['required','integer'],
            'product_picture_count' => ['required','integer'],
            'video_time' => ['required','integer'],
            'video_count' => ['required','integer'],
            'price' => ['required','integer'],
            'special_customer_representative' => ['nullable'],
            'image' => ['nullable'],
            'speacial_customer' => ['required','integer'],
        ];
    }
}
