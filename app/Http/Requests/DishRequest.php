<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            'image' => 'max:5120',
            'price' => 'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được phép để trống',
            'image.max' => 'Ảnh không quá 5MB',
            'price.required' => 'Giá không được để trống',
            'price.min' => 'Giá phải lớn hơn 0'
        ];
    }
}
