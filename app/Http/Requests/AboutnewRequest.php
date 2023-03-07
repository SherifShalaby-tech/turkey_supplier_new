<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutnewRequest extends FormRequest
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
                    // 'title' => 'nullable',
                    'subject' => 'required',
                    'status'  => 'required',
                    'image'   => 'required|mimes:jpg,jpeg,png|max:2000',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'subject' => 'required',
                    'status' => 'required',
                    'image' => 'nullable|mimes:jpg,jpeg,png|max:2000',
                ];
            }
            default: break;
        }
    }
}
