<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CheckOut extends FormRequest
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

        $user = Auth::user();
        if($user == null){
          $required  = 'required|unique:users';
        }else{
          $required  = 'required';  
        }
        return [
            'name' => 'required',
            'email' => $required,
            'phone' => $required,
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.required' => 'Số điện thoại không được phép để trống!',
            'address.required' => 'Danh mục không được phép để trống!',
        ];
    }
}
