<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $classActive = "Màu Sắc"; //Dùng để thêm class text-primary thẻ thẻ <li> ở sidebar
    public function index()
    {
        $colors = Color::all();
        $template = 'admins.colors.list';
        return view('admins.layout', ['title' => 'Danh Sách Màu Sắc', 'template' => $template, 'classActive' => $this->classActive, 'colors' => $colors,]);
    }
    public function create()
    {
        $template = "admins.colors.create";
        return view('admins.layout', [
            'title' => 'Thêm Mới Màu Sắc',
            'template' => $template,
            'classActive' => $this->classActive,
           ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colors,name',
        ], [
            'name.required' => 'Tên màu không được để trống.',
            'name.unique' => 'Màu này đã tồn tại.',
        ]);

        Color::create($request->all());
        return redirect()->route('color.index')->with('success', 'Thêm mới thành công');
    }
    public function edit(string $id){
        $color = Color::find($id);
        $template = "admins.colors.edit";
        return view('admins.layout', [
            'title' => 'Sửa Màu Sắc',
            'template' => $template,
            'classActive' => $this->classActive,
            'color' => $color,
            ]);
    }
    public function update(Request $request, string $id){
        $request->validate([
            'name' => 'required|unique:colors,name,'.$id,
            ], [
                'name.required' => 'Tên màu không được để trống.',
                'name.unique' => 'Màu này đã tồn tại.',
                ]);
                Color::find($id)->update($request->all());
                return redirect()->route('color.index')->with('success', 'Sửa thành công');
    }
    public function destroy(string $id){
        Color::destroy($id);
        return redirect()->route('color.index')->with('success', 'Xóa thành công');
        }
}
