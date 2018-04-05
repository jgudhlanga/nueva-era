<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:address_types'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.unique' => 'Name has to be unique',
        ];
    }
}
