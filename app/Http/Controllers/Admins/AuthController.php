<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Form đăng nhập admin
    public function index(){ 
        return view('admins.logins.login', ['title' => 'Login']);
    }

    //Đăng nhập admin
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

        //Kiểm tra xem email, password có đúng không và role là admin và nhân viên
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])){
            // role là 1 hoặc 2
            if (in_array(Auth::user()->role, [1, 2])) { 
                //Đăng nhập thành công, chuyển sang trang giao diện admin và tạo session success = 'Đăng nhập thành công'
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
            }
            Auth::logout(); // Đăng xuất nếu role không phù hợp
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->back()->with('error', 'Tài khoản không có quyền truy cập');
        }
        
        //Đăng nhập không thành công, hiện lại form đăng nhập admin và tạo session error = 'Email hoặc mật khẩu không chính xác'
        return redirect()->back()->with("error", "Email hoặc mật khẩu không chính xác");
    }
    
    //Đăng xuất admin
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //Đăng xuất và chuyển đến form đăng nhập admin
        return redirect()->route("admin.login")->with("success", "Đăng xuất thành công");
    }
}