<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:100",
            "email" => "required|email|max:100|unique:users,email,".$this->route('user'),
            "phone" => [
            "nullable",
            "min:10",
            "max:20",
            "regex:/^(?=(?:.*\d){10})[0-9a-zA-Z\(\)\+\.\-\s]*$/", //Đảm bảo có ít nhất 10 chữ số
            "regex:/^\+?[0-9\s\(\)\-\.]{10,}$/" //Định dạng số điện thoại quốc tế hợp lệ
        ],
            "password" => "required|min:8|max:20",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "address" => "nullable|max:255"
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống họ tên',
            'name.max' => 'Họ tên quá dài',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email quá dài',
            'email.unique' => 'Email này đã có người sử dụng',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại không quá 20 ký tự',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'password.required' => 'Không được để trông mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu không quá 20 ký tự',
            'image.image' => 'Ảnh sai định dạng',
            'image.mimes' => 'Ảnh phải là jpeg, png, jpg',
            'image.max' => 'Dung lượng ảnh quá lớn',
            'address.max' => 'Địa chỉ quá dài'
        ];
    }
}