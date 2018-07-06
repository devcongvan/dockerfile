<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {
        return [
            'sk_name'=>'required|max:191|unique:skills,sk_name,'.$request->get('id')
        ];
    }

    public function messages()
    {
        return [
          'sk_name.required'=>'Tên kỹ năng không được để trống',
            'sk_name.unique'=>'Tên kỹ năng đã tồn tại',
            'sk_name.max'=>'Tên kỹ năng quá dài'
        ];
    }
}
