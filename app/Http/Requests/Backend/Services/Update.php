<?php

namespace App\Http\Requests\Backend\Services;

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
            'id' => 'required|exists:services,id',
            'name' => 'required|string',
            // 'images' => 'nullable|array',
            'description' => 'nullable',
            'video_link' => 'nullable',
            'images' => 'nullable',
            'images.*' => 'mimes:jpg,jpeg,png,gif|max:3000',
        ];
    }
}
