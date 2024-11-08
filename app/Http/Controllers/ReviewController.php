<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Hàm lưu đánh giá
    public function store(Request $request, $orderId, $orderDetailId)
    {
        // Kiểm tra nếu đã đánh giá sản phẩm trong đơn hàng này
        $existingReview = Review::where('order_detail_id', $orderDetailId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này trong đơn hàng này rồi.');
        }

        // Validate dữ liệu
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'product_id' => 'required|exists:products,id',
            'order_detail_id' => 'required|exists:order_details,id',
        ]);

        // Tạo đánh giá mới
        Review::create([
            'star' => $request->rating,
            'content' => $request->comment,
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'order_detail_id' => $request->order_detail_id,
        ]);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công.');
    }


    // Hiển thị danh sách đánh giá cho sản phẩm
    public function index($productId)
    {
        $reviews = Review::with('user')->where('product_id', $productId)->get();
        return view('reviews.index', compact('reviews', 'productId'));
    }
}
