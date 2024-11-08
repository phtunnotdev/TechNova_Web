<?php

namespace App\Http\Controllers\Admins\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected $classActive = "Danh mục";
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(4);
    
        $template = 'admins.categories.list';
    
        return view('admins.layout', [
            'title' => 'Danh Sách Danh Mục',
            'template' => $template,
            'classActive' => $this->classActive,
            'categories' => $categories,
        ]);
    }
    
    public function create()
    {
        $template = "admins.categories.create";

        return view('admins.layout', [
         'title' => 'Tạo Mới Danh Mục',
         'template' => $template,
         'classActive' => $this->classActive,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Tên danh mục không được để trống.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'image.required' => 'Hình ảnh không được để trống.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB'
        ]);
    
        $imagePath = $request->file('image')->store('categories', 'public');
    
        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('categories.create')->with('success', 'Danh mục đã được thêm thành công!');
    }    
    
    public function edit($id)
    {
        $category = Category::find($id); // Lấy user hiện tại
    
        $template = "admins.categories.edit";
        
        if ($category) {
            return view('admins.layout', [
                'title' => 'Cập Nhật Khách Hàng',
                'template' => $template,
                'category' => $category,
                'classActive' => $this->classActive
            ]);
        }
    }    
    
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id); // Tìm danh mục hiện tại

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Tên danh mục không được để trống.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB'
        ]);
        
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công!');
    }
}
