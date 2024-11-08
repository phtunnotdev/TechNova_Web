<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{   
    //Form đăng nhập client
    public function login(){
        $template = "clients.logins.login";
        return view("clients.layout", ["title" => "Đăng Nhập", "template" => $template]);
    }

    //Đăng nhập client
    public function store(Request $request){
        //Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ], [
           'email.required' => "Không được để trống email",
           'email.email' => "Email không đúng định dạng",
           'password.required' => "Không được để trống mật khẩu",
           'password.min' => "Mật khẩu phải có ít nhất 8 ký tự",
        ]);

        //Kiểm tra xem email, password có đúng không
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 3, //Vai trò là người dùng
        ])){
            //Đăng nhập thành công chuyển sang trang giao diện client và tạo biến success = 'Đăng nhập thành công'
            return redirect()->route('client.index')->with('success', 'Đăng nhập thành công');
        }

        //Đăng nhập không thành công, hiện lại form đăng nhập client và tạo session error = 'Email hoặc mật khẩu không chính xác'
        return redirect()->back()->with("error", "Email hoặc mật khẩu không chính xác");
    }

    //Form đăng nhập client
    public function signup(){
        $template = "clients.logins.signup";
        return view("clients.layout", ["title" => "Đăng Ký", "template" => $template]);
    }
    
    //Đăng nhập client
    public function storeSignup(Request $request){
        //Validate
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required_with:password|same:password'
        ], [
            'name.required' => 'Không được để trống họ tên',
            'name.max' => 'Họ tên quá dài',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email quá dài',
            'email.unique' => 'Email này đã có người sử dụng',
            'password.required' => 'Không được để trông mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu không quá 20 ký tự',
            'password_confirmation.required_with' => 'Không được để trống xác nhận mật khẩu',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp',
        ]);

        //Tạo biến password
        $password = $request->input('password');

        //Tạo user
        User::create([
            "user_code" => "UR-".Str::random(5),
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            'show_password' => $password,
            'password' => Hash::make($password),
            "role" => 3
        ]);

        //Đăng nhập thành công, hiện form đăng nhập client và tạo session success = 'Signuped successfully'
        return redirect()->route('client.login')->with("success","Signuped successfully");
    }
    
    //Đăng xuất client
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //Đăng xuất và chuyển đến form đăng nhập client
        return redirect()->route("client.login")->with("success", "Logged out");
    }
}