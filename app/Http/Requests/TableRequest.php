<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
            'name' => 'required',
            'people' => 'required|min:1',
            'floor' => 'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên bàn ăn không được phép để trống',
            'people.required' => 'Số lượng người không được bỏ trống',
            'people.min' => 'Số lượng người phải lớn hơn 0',
            'floor.required' => 'Tầng không được phép bỏ trống',
            'floor.min' => 'Tầng phải lớn hơn 0'
        ];
    }
}
