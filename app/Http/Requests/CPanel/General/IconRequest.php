<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class IconRequest extends FormRequest
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
	        'class' => 'required|unique:icons',
        ];
    }
	
	public function messages()
	{
		return [
			'class.required' => 'Class Title is required',
			'class.unique' => 'Class Title has to be unique',
		];
	}
	
}