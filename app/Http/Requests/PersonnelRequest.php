<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
            'sex' => 'required',
            'age' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'commune_id' => 'required',
            'phone' =>'required|regex:/^[0-9]+$/i',
            'email' => 'required',
            'bank' =>'required',
            'account_number' =>'required|regex:/^[0-9]+$/i',
            'image' =>'max:5120'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được phép để trống',
            'sex.required' => 'Giới tính không được phép để trống',
            'age.required' => 'Tuổi không được phép để trống',
            'address.required' => 'Địa chỉ không được phép để trống',
            'phone.required' => 'Số điện thoại không được phép để trống',
            'email.required' => 'Email không được phép để trống',
            'bank.required' => 'Ngân hàng không được phép để trống',
            'account_number.required' => 'Số tài khoản không được phép để trống',
            'image.max' => 'Ảnh không quá 5MB',
            'account_number.regex' => 'Chỉ là số',
            'phone.regex' => 'Chỉ là số',
            'province_id.required' => 'Tên tỉnh/thành phố không được phép để trống',
            'district_id.required' => 'Tên huyện/quận không được phép để trống',
            'commune_id.required' => 'Tên xã/phường không được phép để trống'
        ];
    }
}
