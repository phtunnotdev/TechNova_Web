<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    //
    public function show(string $id){
        $order=Order::findOrFail($id);
        if ($order) {
            $template = "clients.accounts.orderdetail";
            return view("clients.layout", ["title" => "Chi tiết sản phẩm", "template" => $template, 'order' => $order]);
        }
    }
}
