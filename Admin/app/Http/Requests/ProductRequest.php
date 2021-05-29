<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'status' => 'required',
            'discount' => 'bail|required|max:100|min:0', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được phép để trống!',
            'quantity.required' => 'Số lượng không được phép để trống!',
            'price.required' => 'Giá không được phép để trống!',
            'category_id.required' => 'Danh mục không được phép để trống!',
            'content.required' => 'Mô tả không được phép để trống!',
            'status.required' => 'Trạng thái không được phép để trống!',
            'discount.required' => 'Giảm giá không được phép để trống!',
        ];
    }
}
