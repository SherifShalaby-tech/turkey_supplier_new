<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TradeShowRequest extends FormRequest
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
            'title' => ['required','string','max:100'],
            // 'video' => ['nullable','mimes:mp4,mov,ogg,qt', 'max:20000'],
            'description' => ['required','max:2500'],
            'images' => 'nullable',
//            'images.*' => 'mimes:jpg,jpeg,png,gif|max:3000',
            'linkurl' => 'nullable|url',
            'videourl' => 'nullable',
        ];
    }
}
