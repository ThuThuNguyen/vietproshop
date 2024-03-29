<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategory extends FormRequest
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
            'name'=>'required|unique:category,name,'.$this->id_cate.',id',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Tên danh mục không được để trống',
            'name.unique'=>'Tên danh mục không được trùng nhau',
        ];
    }
}
