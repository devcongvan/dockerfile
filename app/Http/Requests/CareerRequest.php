<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

use Illuminate\Http\Request;
class CareerRequest extends FormRequest
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
            'ca_name'=>'required|max:191|unique:careers,ca_name,'.$request->get('id')
        ];
    }

    public function messages()
    {
        return [
            'ca_name.required'=>'Tên ngành nghề không được để trống',
            'ca_name.unique'=>'Tên ngành nghề đã tồn tại',
            'ca_name.max'=>'Tên ngành nghề quá dài'
        ];
    }



}
