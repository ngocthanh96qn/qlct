<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostToPage extends FormRequest
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
            'link' => 'required',
            'pages' => 'required',
        ];
    }
    public function messages ()
    {
        return [
            'link.required' => 'Quên Nhập Link rồi!',
            'pages.required' => 'Quên chọn Page rồi!',
        ];
    }
}
