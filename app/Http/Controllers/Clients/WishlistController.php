<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Hàm để thêm sản phẩm vào danh sách yêu thích
    public function addToWishlist($productId, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('client.login')->with('error', 'Vui lòng đăng nhập');
        }

        // Tìm sản phẩm
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích chưa
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            return redirect()->back()->with('error', 'Sản phẩm đã tồn tại trong danh sách yêu thích!');
        } else {
            // Nếu sản phẩm chưa tồn tại, tạo mới
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('client.wishlist')->with('success', 'Sản phẩm đã được thêm vào danh sách yêu thích!');
    }

    // Hiển thị danh sách yêu thích
    public function showWishlist()
    {
        $wishlists = Wishlist::with('product.productVariants') // Nạp các mối quan hệ bổ sung
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        // dd($wishlists);
        $template = "clients.wishlists.favorite";
        return view("clients.layout", ["title" => "Wishlist", "template" => $template, "wishlists" => $wishlists]);
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function removeFromWishlist(String $id)
    {
        // Tìm sản phẩm trong danh sách yêu thích theo ID
        $wishlistItem = Wishlist::find($id);

        // Nếu sản phẩm tồn tại trong danh sách yêu thích, xóa nó
        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->route('client.wishlist')->with('success', 'Sản phẩm đã được xóa khỏi danh sách yêu thích!');
        }

        return redirect()->route('client.wishlist')->with('error', 'Không tìm thấy sản phẩm để xóa!');
    }
}
