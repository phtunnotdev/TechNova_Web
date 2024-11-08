<?php

namespace App\Http\Controllers\Clients;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;

use App\Models\SlideShow;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //Trang chủ client

    public function index()
    {
        $slideShow = SlideShow::where('active', 'on')->first();
        $categories = Category::orderByDesc('created_at')->get();
        $newProducts = Product::withMin('productVariants', 'price') //Lấy giá thấp nhất
            ->withMax('productVariants', 'price') //Lấy giá cao nhất
            ->withSum('productVariants', 'quantity') //Lấy tổng số lượng
            ->withAvg('reviews', 'star')
            ->orderByDesc('created_at')
            ->get();

        // Lấy sản phẩm nổi bật dựa theo lượt xem
        $featuredProducts = Product::withMin('productVariants', 'price')
            ->withMax('productVariants', 'price')
            ->withSum('productVariants', 'quantity')
            ->withAvg('reviews', 'star')
            ->orderByDesc('view')
            ->take(10)
            ->get();

        $wishlistedProductIds = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();

        $template = "clients.homes.index";
        return view("clients.layout", [

            "title" => "Trang chủ",
            "template" => $template,
            "categories" => $categories,
            "newProducts" => $newProducts,
            "title" => "Trang chủ",
            "template" => $template,
            "categories" => $categories,
            "newProducts" => $newProducts,
            "featuredProducts" => $featuredProducts,
            'wishlistedProductIds' => $wishlistedProductIds,
            "slideShow" => $slideShow
        ]);
    }
}
