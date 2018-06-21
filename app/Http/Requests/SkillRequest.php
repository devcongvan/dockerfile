<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            'sk_name'=>'required|unique:skills,sk_name'
        ];
    }

    public function messages()
    {
        return [
          'sk_name.required'=>'Tên kỹ năng không được để trống',
            'sk_name.unique'=>'Tên kỹ năng đã tồn tại'
        ];
    }
}
