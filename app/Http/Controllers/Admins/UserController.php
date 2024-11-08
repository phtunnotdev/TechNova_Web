<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admins\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $classActive = "Khách Hàng"; //Dùng để thêm class text-primary thẻ thẻ <li> ở sidebar

    public function index(Request $request)
    {
        //Lấy danh sách user xếp theo created_at desc, nếu created_at = nhau thì lấy theo id desc
        $users = User::where("status", $request->input("status") && $request->input("status") != 0 ? $request->input("status") : "LIKE", "%") //Filter theo trạng thái
        ->where(function($query) use ($request) {
            $query->where("name", "LIKE", $request->input("keyWord") ? "%".$request->input("keyWord")."%" : "%") //Filter theo tên user
            ->orWhere("user_code", "LIKE", $request->input("keyWord") ? "%".$request->input("keyWord")."%" : "%"); //Filter theo mã user
        })
        ->where("role", 3)
        ->orderBy("created_at", $request->input("orderBy") && $request->input("orderBy") === "oldest" ? "asc" : "desc") //Filter theo mới, cũ nhất
        ->orderBy('id', $request->input("orderBy") && $request->input("orderBy") === "oldest" ? "asc" : "desc") //Filter theo mới, cũ nhất
        ->paginate($request->input("perPage") ? $request->input("perPage") : 8); //Lấy bao nhiêu bản ghi

        $template = 'admins.users.list'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
         'title' => 'Danh Sách Khách Hàng',
         'template' => $template,
         'classActive' => $this->classActive,
         'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $template = "admins.users.create";

        return view('admins.layout', [
         'title' => 'Tạo Mới Khách Hàng',
         'template' => $template,
         'classActive' => $this->classActive,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if($request->isMethod("POST")){

            $userCode = "UR-".Str::random(5); //Tạo một mã bất kỳ
            $userExists = User::where('user_code', $userCode)->exists(); //Xem mã có bị trùng không
            if($userExists){ //Nếu trùng thông báo lỗi
                return redirect()->back()->with('error','Tạo mới khách hàng thất bại');
            }

            //Sử lý hình ảnh
            if($request->hasFile("image")){
                //Thêm hình ảnh
                $image = $request->file('image')->store('uploads/users', "public");
            }else{
                $image = NULL;
            }

            //Tạo user
            User::create([
             "user_code" => $userCode,
             "name" => $request->input("name"),
             "email" => $request->input("email"),
             "phone" => $request->input("phone"),
             "image" => $image,
             "address" => $request->input("address"),
             "status" => $request->input("status") ? "active" : "banned",
             "show_password" => $request->input("password"),
             "password" => Hash::make($request->input("password")),
             "role" => 3,
            ]);

            return redirect()->route('user.index')->with('success','Tạo mới khách hàng thành công');
        }

        return redirect()->back()->with('error','Tạo mới khách hàng thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id); //Lấy user hiện tại

        if($user && $user->role == 3){

            $template = "admins.users.detail";

            return view('admins.layout', [
             'title' => 'Chi Tiết Khách Hàng',
             'template' => $template,
             'user' => $user,
             'classActive' => $this->classActive
            ]);
        }

        return redirect()->back()->with('error','Không tìm thấy khách hàng');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id); //Lấy user hiện tại

        if($user && $user->role == 3){

            $template = "admins.users.edit";

            return view('admins.layout', [
             'title' => 'Sửa Khách Hàng',
             'template' => $template,
             'user' => $user,
             'classActive' => $this->classActive
            ]);
        }

        return redirect()->back()->with('error','Không tìm thấy khách hàng');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        if($request->isMethod("PUT")){

        $user = User::find($id); //Tìm user đấy

        if($user && $user->role == 3){ //Nếu có
            if ($request->hasFile('image')) {  //Nếu có ảnh
                if($user->image && Storage::disk('public')->exists($user->image)){ //Kiểm tra có image trong csdl và public hay không
                    Storage::disk('public')->delete($user->image); //Nếu có thì xóa ảnh đấy
                }
                $image = $request->file('image')->store("uploads/users", "public"); //Lưu ảnh mới
            }else{
                $image = $user->image; //Giũ lại ảnh cũ
            }

            //Cập nhật
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->image = $image;
            $user->address = $request->input('address');
            $user->status = $request->input('status') ? "active" : "banned";
            $user->show_password = $request->input('password');
            $user->password = Hash::make($request->input('password'));
            $user->save(); //Lưu

            return redirect()->route('user.index')->with('success','Cập nhật khách hàng thành công');
        }

        return redirect()->back()->with('error','Không tìm thấy khách hàng');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if($user && $user->role == 3){
            $user->delete(); //Xóa mềm
            return redirect()->back()->with("success", "Chuyển vào thùng rác thành công");
        }

        return redirect()->back()->with("error", "Không tìm thấy khách hàng");
    }
}