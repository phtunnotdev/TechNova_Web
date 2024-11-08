<?php

namespace App\Http\Controllers\Admins\Trashs;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $classActive = "Khách Hàng";
    
    //Hiện danh sách user đã xóa
    public function index(Request $request)
    {        
        //Lấy danh sách user xếp theo created_at desc, nếu created_at = nhau thì lấy theo id desc
        $users = User::where("status", $request->input("status") && $request->input("status") != 0 ? $request->input("status") : "LIKE", "%") //Filter theo trạng thái
        ->where(function($query) use ($request) {
            $query->where("name", "LIKE", $request->input("keyWord") ? "%".$request->input("keyWord")."%" : "%") //Filter theo tên user
            ->orWhere("user_code", "LIKE", $request->input("keyWord") ? "%".$request->input("keyWord")."%" : "%"); //Filter theo mã user
        })
        ->where("role", 3)
        ->orderBy("deleted_at", $request->input("orderBy") && $request->input("orderBy") === "oldest" ? "asc" : "desc") //Filter theo mới, cũ nhất
        ->orderBy('id', $request->input("orderBy") && $request->input("orderBy") === "oldest" ? "asc" : "desc") //Filter theo mới, cũ nhất
        ->onlyTrashed() //Lấy danh sách đã xóa
        ->paginate($request->input("perPage") ? $request->input("perPage") : 8); //Lấy bao nhiêu bản ghi

        $template = 'admins.users.trash'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
         'title' => 'Khách Hàng Đã Xóa',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    //Restore 1 user
    public function update(Request $request, string $id)
    {
        if($request->isMethod("PUT")){
            
            $user = User::onlyTrashed()->find($id); //Tìm user đã xóa có id đấy

            if($user && $user->role == 3){
             $user->restore(); //Khôi phục
             return redirect()->back()->with("success", "Khôi phục thành công");
            }

            return redirect()->back()->with("error", "Không tìm thấy khách hàng");
        }

        return redirect()->back()->with("error", "Khôi phục thất bại");
    }

    /**
     * Remove the specified resource from storage.
     */

    //Xóa vĩnh viễn 1 user
    public function destroy(string $id)
    {
        $user = User::onlyTrashed()->find($id); //Tìm user đã xóa có id đấy

        if($user && $user->role == 3){
            
            if($user->image && Storage::disk('public')->exists($user->image)){ //Nếu có ảnh thì xóa ảnh
            Storage::disk('public')->delete($user->image);
            }

            $user->forceDelete(); //Xóa vĩnh viễn 1 user
            return redirect()->back()->with("success", "Xóa vĩnh viễn thành công");
        }

        return redirect()->back()->with("error", "Không tìm thấy khách hàng");
    }

    //Xóa mềm nhiều
    public function trash(Request $request){
        if($request->isMethod("POST")){

        $arrayOfValues = explode(',', $request->input("selectedValues")); //Lấy tất cả id đc chọn
        
        foreach($arrayOfValues as $arrayOfValue){
            $user = User::find($arrayOfValue);
            if($user && $user->role == 3){
             $user->delete(); //Xóa mềm nhiều
            }else{
             return redirect()->back()->with("error", "Không tìm thấy khách hàng");
            }
        }

        return redirect()->back()->with("success", "Chuyển vào thùng rác thành công");
        }

        return redirect()->back()->with("error", "Chuyển vào thùng rác thất bại");
    }
    
    //Xóa vĩnh viễn nhiều
    public function delete(Request $request){
        if($request->isMethod("POST")){
        $arrayOfValues = explode(',', $request->input("selectedValues")); //Lấy tất cả id đc chọn
        
        foreach($arrayOfValues as $arrayOfValue){
            $user = User::onlyTrashed()->find($arrayOfValue);

            if($user && $user->role == 3){
            if($user->image && Storage::disk('public')->exists($user->image)){ //Nếu có ảnh thì xóa ảnh
            Storage::disk('public')->delete($user->image);
            }
            $user->forceDelete();

            }else{
            return redirect()->back()->with("error", "Không tìm thấy khách hàng");
            }
        }
        
        return redirect()->back()->with("success", "Xóa vĩnh viễn thành công");
        }

        return redirect()->back()->with("error", "Xóa vĩnh viễn thất bại");
    }

    public function restore(Request $request) {
        if($request->isMethod("POST")){

        $arrayOfValues = explode(',', $request->input("selectedValues")); //Lấy tất cả id đc chọn
        
        foreach($arrayOfValues as $arrayOfValue){

            $user = User::onlyTrashed()->find($arrayOfValue); //Tìm user đã xóa

            if($user && $user->role == 3){
                $user->restore(); //Khôi phục
            }else{
                return redirect()->back()->with("error", "Không tìm thấy khách hàng");
            }
        }

        return redirect()->back()->with("success", "Khôi phục thành công");
        }

        return redirect()->back()->with("error", "Khôi phục thất bại");
    }
}