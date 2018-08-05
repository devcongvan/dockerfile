<?php

namespace App\Http\Requests;

use App\Http\Validations\CheckDomain;
use Illuminate\Validation\Factory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SourceRequest extends FormRequest
{
    public function __construct(Factory $factory)
    {
        $this->useCustomValidations($factory,$this->applicableValidations());
    }


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
            'so_name'=>'is_domain|required|max:191|unique:sources,so_name,'.$request->get('id')

        ];
    }

    public function messages()
    {
        return [
            'so_name.required'=>'Tên nguồn không được để trống',
            'so_name.unique'=>'Tên nguồn đã tồn tại',
            'so_name.max'=>'Tên nguồn quá dài'
        ];
    }

    private function applicableValidations()
    {
        return collect([
            new CheckDomain(),
            // thêm các class Validator khác vào đây
        ]);
    }

    private function useCustomValidations($factory, $validations)
    {
        $validations->each(function ($validation) use ($factory) {
            $factory->extend($validation->name(), $validation->test(), $validation->errorMessage());
        });
    }
}
