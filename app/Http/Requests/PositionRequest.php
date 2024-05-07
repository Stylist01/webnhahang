<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'wage' => 'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên nhân viên không được phép để trống',
            'wage.required' => 'Lương không được bỏ trống',
            'wage.min' => 'Lương phải lớn hơn 0',
        ];
    }
}
