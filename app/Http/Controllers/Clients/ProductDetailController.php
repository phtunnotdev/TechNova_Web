<?php

namespace App\Http\Controllers\Clients;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProductDetailController extends Controller
{
    public function productDetail(string $id)
    {
        // Lấy thông tin sản phẩm cùng với các thông tin thống kê
        $product = Product::with('category') // Nối bảng category để lấy thông tin danh mục
            ->withMin('productVariants', 'price') // Lấy giá thấp nhất
            ->withMax('productVariants', 'price') // Lấy giá cao nhất
            ->withSum('productVariants', 'quantity') // Lấy tổng số lượng
            ->with('reviews.user')
            ->withCount('reviews') // Đếm tổng số đánh giá cho sản phẩm
            ->withAvg('reviews', 'star') // Tính điểm đánh giá trung bình cho sản phẩm
            ->find($id);

        if (!$product) {
            // Nếu không tìm thấy sản phẩm, trả về trang trước đó với thông báo lỗi
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
        }

        // Tăng lượt xem lên 1
        $product->increment('view');

        // Lưu sản phẩm đã xem vào session
        $recentlyViewedProducts = session('recently_viewed_products', []);

        // Kiểm tra xem sản phẩm đã có trong danh sách chưa
        if (!in_array($id, $recentlyViewedProducts)) {
            $recentlyViewedProducts[] = $id; // Thêm sản phẩm vào danh sách
        }

        session(['recently_viewed_products' => $recentlyViewedProducts]); // Cập nhật session

        // Lấy lượt xem hiện tại
        $viewsCount = $product->views;

        // Lấy sản phẩm liên quan
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(4) // Giới hạn số lượng sản phẩm liên quan
            ->get();


        $averageRating = $product->reviews_avg_star ?? 0;

        // Chọn template để hiển thị
        $template = "clients.productdetails.productdetail";

        return view("clients.layout", [
            "title" => "Chi tiết sản phẩm",
            "template" => $template,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'viewsCount' => $viewsCount,
            'averageRating' => $averageRating,
        ]);
    }
}
