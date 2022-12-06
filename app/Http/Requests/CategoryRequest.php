<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name'=>'required|max:255',
            'meta_keywords'=>'required|max:255',
            'slug_category_product'=>'required|max:255',
            'category_desc'=>'required|max:255',
            'category_status'=>'required|max:255'
        ];
    
    }
    public function messages()
    {
        return[
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự"
        ];

    }
    public function attributes()
    {
        return[
            'category_name'=>"Tên danh mục",
            'meta_keywords'=>"Từ khóa danh mục",
            'slug_category_product'=>"Slug danh mục",
            'category_desc'=>"Mô tả danh mục",
            'category_status'=>"Trạng thái danh mục"
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
           if($validator->errors()->count() > 0){
             $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
           }
            
        });
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'create_at'=> date('Y-m-d H:i:s'),
        ]);
    }
    protected function failedAuthorization(){
        throw new AuthorizationException('Bạn không có quyền truy cập.');
        // throw new HttpResponseException(redirect('/dashboard'));
    }
}
