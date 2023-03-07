<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HelpcentreRequest extends FormRequest
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
                    'title' => 'required|max:255',
                    'description' => 'nullable',
                    'image'   => 'required|mimes:jpg,jpeg,png|max:2000',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|max:255',
                    'description' => 'nullable',
                    'image' => 'nullable|mimes:jpg,jpeg,png|max:2000',
                ];
            }
            default: break;
        }
    }
}
