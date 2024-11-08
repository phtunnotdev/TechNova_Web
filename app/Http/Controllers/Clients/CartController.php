<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class CartController extends Controller
{
    // Hàm để thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('client.login')->with('error', 'Vui lòng đăng nhập');
        }

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate(
            [
                'product' => 'required|exists:products,id',
                'color' => 'required|exists:colors,id',
                'ssd' => 'required|exists:ssds,id',
                'quantity' => 'required|integer|min:1',
            ],
            [
                'color.required' => "Vui lòng nhập màu",
                'color.exists' => "Màu không hợp lệ",
                'ssd.required' => "Vui lòng nhập ssd",
                'quantity.required' => "Vui lòng nhập số lượng",
                'quantity.integer' => "Số lượng phải là số nguyên",
                'quantity.min' => "Số lượng phải lớn hơn 0"
            ]
        );

        $product = Product::find($validatedData['product']);
        $productVariant = $product->productVariants->where('color_id', $validatedData['color'])->where('ssd_id', $validatedData['ssd'])->first();
        if (!$productVariant) {
            return redirect()->back()->with('error', 'Thêm giỏ hàng không thành công');
        }

        // Kiểm tra xem sản phẩm có còn trong kho không
        if ($productVariant->quantity < $validatedData['quantity']) {
            return redirect()->back()->with('error', 'Số lượng vượt quá số lượng có sẵn!');
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('variant_id', $productVariant->id)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $cartItem->variant_quantity += $validatedData['quantity'];

            // Kiểm tra lại số lượng trong kho
            if ($productVariant->quantity < $cartItem->variant_quantity) {
                return redirect()->back()->with('error', 'Số lượng sản phẩm yêu cầu vượt quá số lượng có sẵn!');
            }

            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa tồn tại, tạo mới
            Cart::create([
                'user_id' => Auth::id(),
                'variant_id' => $productVariant->id,
                'variant_quantity' => $validatedData['quantity'],
            ]);
        }

        return redirect()->route('client.cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    public function showCart()
    {
        $carts = Cart::with(['productVariant.ssd', 'productVariant.color'])
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();
        $template = "clients.carts.cart";
        return view("clients.layout", ["title" => "Checkout", "template" => $template, "carts" => $carts]);
    }

    public function updateCart(Request $request)
    {
        $count = Cart::where('user_id', Auth::id())->get();
        if ($count->isEmpty()) {
            return redirect()->route('client.cart')->with('error', 'Chưa có sản phẩm nào trong giỏ hàng');
        }
        if (!$request->quantities || count($request->quantities) !== $count->count()) {
            return redirect()->route('client.cart')->with('error', "Lỗi cập nhật giỏ hàng");
        }
        foreach ($request->quantities as $cartId => $quantity) {
            if ($quantity <= 0) {
                return redirect()->route('client.cart')->with('error', 'Số lượng sản phẩm phải lớn hơn không');
            }
            $cart = Cart::find($cartId);
            if ($cart) {
                // Kiểm tra xem biến thể có còn trong kho không
                $variant = ProductVariant::find($cart->variant_id);
                if ($variant->quantity < $quantity) {
                    return redirect()->back()->with('error', 'Số lượng sản phẩm yêu cầu vượt quá số lượng có sẵn!');
                }

                $cart->variant_quantity = $quantity;
                $cart->save();
            } else {
                return redirect()->route('client.cart')->with('error', "Lỗi cập nhật giỏ hàng");
            }
        }

        return redirect()->route('client.cart')->with('success', 'Giỏ hàng đã được cập nhật!');
    }


    public function removeFromCart(String $id)
    {
        // Tìm giỏ hàng theo ID
        $cartItem = Cart::find($id);

        // Nếu sản phẩm tồn tại trong giỏ hàng, xóa nó
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('client.cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }

        return redirect()->route('client.cart')->with('error', 'Không tìm thấy sản phẩm để xóa!');
    }
}
