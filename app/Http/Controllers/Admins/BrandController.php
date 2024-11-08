<?php

namespace App\Http\Controllers\Admins;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $classActive = "Hãng";

    public function index()
    {
        $brands = Brand::orderBy("created_at")->paginate(5);

        $template = 'admins.brands.list'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
         'title' => 'Danh Sách Hãng',
         'template' => $template,
         'classActive' => $this->classActive,
         'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $template = "admins.brands.create";

        return view('admins.layout', [
         'title' => 'Tạo Mới hãng',
         'template' => $template,
         'classActive' => $this->classActive,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod("POST")){

            $request->validate([
                "name" => "required|max:100",
                "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
            ],
            [
                'name.required' => 'Không được để trống tên hãng',
                'name.max' => 'Tên hãng quá dài',
                'image.required' => 'không được để trống ảnh',
                'image.image' => 'Ảnh sai định dạng',
                'image.mimes' => 'Ảnh phải là jpeg, png, jpg',
                'image.max' => 'Dung lượng ảnh quá lớn'
            ]);

            //Sử lý hình ảnh
            if($request->hasFile("image")){
                //Thêm hình ảnh
                $image = $request->file('image')->store('uploads/brands', "public");
            }else{
                $image = NULL;
            }

            //Tạo brand
            Brand::create([
             "name" => $request->input("name"),
             "image" => $image,
            ]);

            return redirect()->route('brand.index')->with('success','Tạo mới hãng thành công');
        }

        return redirect()->back()->with('error','Tạo mới hãng thất bại');
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
        $brand = Brand::find($id); //Lấy brand hiện tại

        if($brand){
            
            $template = "admins.brands.edit";

            return view('admins.layout', [
             'title' => 'Sửa hãng',
             'template' => $template,
             'classActive' => $this->classActive,
             'brand' => $brand,
            ]);
        }
        
        return redirect()->back()->with('error','Không tìm thấy hãng');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod("PUT")){
            
            $request->validate([
                "name" => "required|max:100",
                "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            ],
            [
                'name.required' => 'Không được để trống tên hãng',
                'name.max' => 'Tên hãng quá dài',
                'image.image' => 'Ảnh sai định dạng',
                'image.mimes' => 'Ảnh phải là jpeg, png, jpg',
                'image.max' => 'Dung lượng ảnh quá lớn'
            ]);

            $brand = Brand::find($id); //Tìm brand đấy
    
            if($brand){ //Nếu có
                if ($request->hasFile('image')) {  //Nếu có ảnh
                    if($brand->image && Storage::disk('public')->exists($brand->image)){ //Kiểm tra có image trong csdl và public hay không
                        Storage::disk('public')->delete($brand->image); //Nếu có thì xóa ảnh đấy
                    }
                    $image = $request->file('image')->store("uploads/brands", "public"); //Lưu ảnh mới
                }else{
                    $image = $brand->image; //Giữ lại ảnh cũ
                }
    
                //Cập nhật
                $brand->name = $request->input('name');
                $brand->image = $image;
                $brand->save(); //Lưu
    
                return redirect()->route('brand.index')->with('success','Cập nhật hãng thành công');
            }
    
            return redirect()->back()->with('error','Không tìm thấy hãng');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id); //Tìm brand

        if($brand){
            
            if($brand->image && Storage::disk('public')->exists($brand->image)){ //Nếu có ảnh thì xóa ảnh
            Storage::disk('public')->delete($brand->image);
            }

            $brand->delete(); //Xóa vĩnh viễn
            return redirect()->back()->with("success", "Xóa thành hãng công");
        }

        return redirect()->back()->with("error", "Không tìm thấy hãng");
    }
}