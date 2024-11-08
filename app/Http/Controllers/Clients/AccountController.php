<?php

namespace App\Http\Controllers\Clients;

use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function account()
    {
        $orders = Order::where('user_id', Auth::id())->orderByDesc('created_at')->get();
        $template = "clients.accounts.account";
        return view("clients.layout", ["title" => "Account", "template" => $template, "orders" => $orders]);
    }

    public function orderDetail(string $id)
    {
        $order = Order::find($id);
        if($order && $order->user_id === Auth::id()){
        $template = "clients.accounts.orderdetail";
        return view("clients.layout", ["title" => "Chi tiết đơn hàng", "template" => $template, "order" => $order]);
        }

        return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
    }
    public function thanhCong()
    {
        $template = "clients.accounts.thanhcong";
        return view("clients.layout", ["title" => "Thanh toán thành công", "template" => $template]);
    }

    public function confirm(string $id)
    {
        $order = Order::find($id);
        if($order && $order->user_id === Auth::id() && $order->status === "ghtc"){
            $order->status = "dndh";
            $order->save();
            OrderHistory::create([
                "from_status" => "ghtc",
                "to_status" => "dndh",
                "note" => "Đã nhận được hàng",
                "by_user" => Auth::id(),
                "order_id" => $order->id
            ]);
        return redirect()->back()->with("success", "Xác nhận thành công");
        }

        return redirect()->back()->with('error', 'Xác nhận không thành công');
    }

    public function cancel(Request $request, string $id)
    {
        if($request->isMethod('POST')){
        if(!$request->input('note') && !$request->input('noteModel')){
            return redirect()->back()->with("error", "Vui lòng nhập lý do");
        }
        $order = Order::find($id);
        if($order && $order->user_id === Auth::id() && $order->status === "cxn"){
            $order->status = "dh";
            $order->save();
            OrderHistory::create([
                "from_status" => "cxn",
                "to_status" => "dh",
                "note" => $request->input('note') ?? $request->input('noteModel'),
                "by_user" => Auth::id(),
                "order_id" => $order->id
            ]);
        return redirect()->back()->with("success", "Hủy thành công");
        }
        return redirect()->back()->with('error', 'Hủy không thành công do đơn hàng đã được xác nhận');
        }
        return redirect()->back()->with('error', 'Hủy không thành công');
    }
}