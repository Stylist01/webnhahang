<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
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
            'quantity' => 'required|min:1',
            'units' => 'required',
            'price' => 'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên nguyên không được phép để trống',
            'quantity.required' => 'Số lượng không được để trống',
            'quantity.min' => 'Số lượng phải lớn hơn 0',
            'units.required' => 'Đơn vị không được phép bỏ trống',
            'price.required' => 'Giá không được để trống',
            'price.min' => 'Giá phải lớn hơn 0'
        ];
    }
}
