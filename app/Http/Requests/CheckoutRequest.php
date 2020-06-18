<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'full'=>'required|min:7',
            'email'=>'required|email',
            'phone'=>'required|min:7|max:11',
        ];
    }
    public function messages()
    {
        return [
            'full.required'=>'Họ tên không được để trống',
            'full.min'=>'Họ tên không được ít hơn 7 kí tự',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'phone.required'=>'Số điện thoại không được để trống',
            'phone.min'=>'Số điện thoại không được ít hơn 7 kí tự',
            'phone.max'=>'Số điẹn thoại không được nhiều hơn 11 kí tự'
        ];
    }
}
