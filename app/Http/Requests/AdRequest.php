<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
                    'title' => 'required|max:255|unique:ads',
                    'image' => 'required|mimes:jpg,jpeg,png|max:2000',
                    'name_entity' => 'string|nullable',
                    // 'start_date' => 'required|date',
                    // 'end_date' => 'required|date',

                    'start_date'     => 'nullable|date_format:Y-m-d',
                    'end_date'       => 'required_with:start_date|date_format:Y-m-d|after_or_equal:start_date',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|max:255|unique:ads,title,'.$this->route()->ad->id,
                    'image' => 'nullable|mimes:jpg,jpeg,png|max:2000',
                    'name_entity' => 'string|nullable',
                    // 'start_date' => 'required|date',
                    // 'end_date' => 'required|date',
                    'start_date'     => 'nullable|date_format:Y-m-d',
                    'end_date'       => 'required_with:start_date|date_format:Y-m-d|after_or_equal:start_date',
                ];
            }
            default: break;
        }
    }
}
