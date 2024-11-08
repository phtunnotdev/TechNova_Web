<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $classActive = "Mã Giảm Giá";
     
    public function index()
    {
        $vouchers = Voucher::orderByDesc('created_at')->get();

        $template = 'admins.vouchers.list'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
         'title' => 'Danh Sách Mã Giảm Giá',
         'template' => $template,
         'classActive' => $this->classActive,
         'vouchers' => $vouchers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 3)->orderByDesc('created_at')->orderByDesc('id')->get();

        $template = 'admins.vouchers.create'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
         'title' => 'Thêm Mới Mã Giảm Giá',
         'template' => $template,
         'classActive' => $this->classActive,
         'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
        $request->validate([
            'percent' => 'required|integer|min:1|max:90',
            'minPrice' => 'nullable|integer|min:1',
            'maxPrice' => 'required|integer|min:1',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after:startDate',
            'quantity' => 'required|integer|min:1',
        ],
        [
            'percent.required' => 'Không được để trống % giảm giá',
            'percent.integer' => '% giảm giá phải là số nguyên',
            'percent.min' => '% giảm giá phải lớn hơn 0',
            'percent.max' => '% giảm giá quá lớn',
            'minPrice.integer' => 'Giá tối thiểu phải là số nguyên',
            'minPrice.min' => 'Giá tối thiểu phải lớn hơn 0',
            'maxPrice.required' => 'Không được để trống giá tối đa',
            'maxPrice.integer' => 'Giá tối đa phải là số nguyên',
            'maxPrice.min' => 'Giá tối đa phải lớn hơn 0',
            'startDate.required' => 'Không được trống ngày bắt đầu',
            'startDate.date' => 'Ngày bắt đầu phải là ngày',
            'startDate.after_or_equal' => 'Ngày bắt đầu phải lớn hơn hoặc bằng hôm nay',
            'endDate.required' => 'Không được trống ngày kết thúc',
            'endDate.date' => 'Ngày kết thúc phải là ngày',
            'endDate.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
            'quantity.required' => 'Không được để trống số lượng',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng phải lớn hơn 0'
        ]);
        $userIds = $request->input('users') ? implode(',', $request->input('users')) : NULL;
        Voucher::create([
            'voucher_code' => "VR-".Str::random(5),
            'percent' => $request->input('percent'),
            'min_price' => $request->input('minPrice'),
            'max_price' => $request->input('maxPrice'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
            'quantity' => $request->input('quantity'),
            'for_user_ids' => $userIds,
        ]);

        return redirect()->route('voucher.index')->with('success', 'Thêm mã giảm giá thành công');
        }

        return redirect()->back()->with('success', 'Thêm mã giảm giá thất bại');
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
        $voucher = Voucher::find($id);
        $userIds = $voucher->for_user_ids ? explode(',', $voucher->for_user_ids) : NULL;
        $users = User::where('role', 3)->orderByDesc('created_at')->orderByDesc('id')->get();

        $template = 'admins.vouchers.edit'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
            'title' => 'Sửa Mã Giảm Giá',
            'template' => $template,
            'classActive' => $this->classActive,
            'voucher' => $voucher,
            'users' => $users,
            'userIds' => $userIds
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod("PUT")){
        $voucher = Voucher::find($id);
        if($voucher){
        $userIds = $request->input('users') ? implode(',', $request->input('users')) : NULL;
        $voucher->update([
            'percent' => $request->input('percent'),
            'min_price' => $request->input('minPrice'),
            'max_price' => $request->input('maxPrice'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
            'quantity' => $request->input('quantity'),
            'for_user_ids' => $userIds
        ]);

        return redirect()->route('voucher.index')->with('success', 'Cập nhật mã giảm giá thành công');
        }

        return redirect()->back()->with('error', 'Không tìm thấy mã giảm giá');
        }
        return redirect()->back()->with('error', 'Cập nhật mã giảm giá thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::find($id);
        if($voucher){
            $voucher->delete();
            return redirect()->back()->with('success', 'Xóa mã giảm giá thành công');
        }
        return redirect()->back()->with('error', 'Không tìm thấy mã giảm giá');
    }
}