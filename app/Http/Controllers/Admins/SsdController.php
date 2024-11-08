<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Ssd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SsdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $classActive = "Dung Lượng"; //Dùng để thêm class text-primary thẻ thẻ <li> ở sidebar
    public function index()
    {
        $ssds = Ssd::all();
        $template = 'admins.ssds.list';
        return view('admins.layout', ['title' => 'Danh Sách Loại Dung Lượng', 'template' => $template, 'classActive' => $this->classActive, 'ssds' => $ssds,]);
    }
    public function create()
    {
        $template = "admins.ssds.create";
        return view('admins.layout', [
            'title' => 'Thêm Mới Loại Dung Lượng',
            'template' => $template,
            'classActive' => $this->classActive,
           ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:ssds,name',
        ], [
            'name.required' => 'Loại dung lượng không được để trống.',
            'name.unique' => 'Loại dung lượng này đã tồn tại.',
        ]);

        Ssd::create($request->all());
        return redirect()->route('ssd.index')->with('success', 'Thêm mới thành công');
    }
    public function edit(string $id){
        $ssd = Ssd::find($id);
        $template = "admins.ssds.edit";
        return view('admins.layout', [
            'title' => 'Sửa Loại Dung Lượng',
            'template' => $template,
            'classActive' => $this->classActive,
            'ssd' => $ssd,
            ]);
    }
    public function update(Request $request, string $id){
        $request->validate([
            'name' => 'required|unique:ssds,name,'.$id,
            ], [
                'name.required' => 'Loại dung lượng không được để trống.',
                'name.unique' => 'Loại dung lượng này đã tồn tại.',
                ]);
                Ssd::find($id)->update($request->all());
                return redirect()->route('ssd.index')->with('success', 'Sửa thành công');
    }
    public function destroy(string $id){
        Ssd::destroy($id);
        return redirect()->route('ssd.index')->with('success', 'Xóa thành công');
        }
}
