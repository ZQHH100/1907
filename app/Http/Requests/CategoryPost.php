<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryPost extends FormRequest
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
             'cate_name' => 'required|unique:category|max:10|min:2',
        ];
    }
      public function messages(){
     return [
              'cate_name.required'=>'品牌名称必填',
             'cate_name.unique'=>'品牌名称已存在',
              'cate_name.max'=>'品牌名称最大长度为10位',
                'cate_name.min'=>'品牌名称最小长度为2位',
     ];
    }
}
