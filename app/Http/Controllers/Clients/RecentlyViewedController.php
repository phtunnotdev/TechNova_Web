<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecentlyViewedController extends Controller
{
    public function recentlyViewed(Request $request)
    {
        $recentlyViewedProducts = session('recently_viewed_products', []);

        $query = Product::whereIn('id', $recentlyViewedProducts);

        if ($request->input('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        $products = $query->take(10)->get();

        $template = 'clients.views.recentlyViewed';
        return view('clients.layout', [
            'title' => 'Sản phẩm đã xem gần đây',
            'template' => $template,
            'products' => $products,
        ]);
    }
}
