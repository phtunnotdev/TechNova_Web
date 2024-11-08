<?php

namespace App\Http\Controllers\Admins\Trashs;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $classActive = "Sản Phẩm";

    public function index()
    {
        $products = Product::with('category')  // Nạp bảng category
            ->withMin('productVariants', 'price')  // Lấy giá min của productVariants
            ->withMax('productVariants', 'price')  // Lấy giá max của productVariants
            ->withSum('productVariants', 'quantity') // Lấy tổng số lượng
            ->withSum('productVariants', 'sold_quantity') // Tổng số lượng đã bán
            ->withSum('productVariants', 'price') // Tính doanh thu
            // ->withCount('reviews') // Đếm tổng số đánh giá cho từng sản phẩm
            // ->withAvg('reviews', 'rating') // Tính điểm đánh giá trung bình cho sản phẩm
            ->orderByDesc('created_at')
            ->onlyTrashed() // Lấy sản phẩm đã bị xóa mềm
            ->paginate(8);

        $template = 'admins.products.trash'; // Tạo biến template để include vào content của layout

        return view('admins.layout', [
            'title' => 'Sản Phẩm Đã Xóa',
            'template' => $template,
            'classActive' => $this->classActive,
            'products' => $products,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod("PUT")) {

            $product = Product::onlyTrashed()->find($id); //Tìm product đã xóa có id đấy

            if ($product) {
                $product->restore(); //Khôi phục
                return redirect()->back()->with("success", "Khôi phục thành công");
            }

            return redirect()->back()->with("error", "Không tìm thấy sản phẩm");
        }

        return redirect()->back()->with("error", "Khôi phục thất bại");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::onlyTrashed()->find($id); //Tìm product đã xóa có id đấy

        if ($product) {

            foreach ($product->galleries as $gallery) {
                if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                    Storage::disk('public')->delete($gallery->path);
                }
            }

            foreach ($product->productVariants as $productVariant) {
                if ($productVariant->image && Storage::disk('public')->exists($productVariant->image)) {
                    Storage::disk('public')->delete($productVariant->image);
                }
            }

            Storage::disk('public')->delete($product->image);

            $product->forceDelete(); //Xóa vĩnh viễn 1 product
            return redirect()->back()->with("success", "Xóa vĩnh viễn thành công");
        }

        return redirect()->back()->with("error", "Không tìm thấy sản phẩm");
    }

    //Xóa mềm nhiều
    public function trash(Request $request)
    {
        if ($request->isMethod("POST")) {

            $arrayOfValues = explode(',', $request->input("selectedValues")); //Lấy tất cả id đc chọn

            foreach ($arrayOfValues as $arrayOfValue) {

                $product = Product::find($arrayOfValue);

                if ($product) {
                    $product->delete(); //Xóa mềm nhiều
                } else {
                    return redirect()->back()->with("error", "Không tìm thấy sản phẩm");
                }
            }

            return redirect()->back()->with("success", "Chuyển vào thùng rác thành công");
        }

        return redirect()->back()->with("error", "Chuyển vào thùng rác thất bại");
    }

    //Xóa vĩnh viễn nhiều
    public function delete(Request $request)
    {
        if ($request->isMethod("POST")) {
            $arrayOfValues = explode(',', $request->input("selectedValues")); //Lấy tất cả id đc chọn

            foreach ($arrayOfValues as $arrayOfValue) {
                $product = Product::onlyTrashed()->find($arrayOfValue);

                if ($product) {
                    foreach ($product->galleries as $gallery) {
                        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                            Storage::disk('public')->delete($gallery->path);
                        }
                    }
                    foreach ($product->productVariants as $productVariant) {
                        if ($productVariant->image && Storage::disk('public')->exists($productVariant->image)) {
                            Storage::disk('public')->delete($productVariant->image);
                        }
                    }

                    Storage::disk('public')->delete($product->image);
                    $product->forceDelete(); //Xóa cứng

                } else {
                    return redirect()->back()->with("error", "Không tìm thấy sản phẩm");
                }
            }

            return redirect()->back()->with("success", "Xóa vĩnh viễn thành công");
        }

        return redirect()->back()->with("error", "Xóa vĩnh viễn thất bại");
    }

    public function restore(Request $request)
    {
        if ($request->isMethod("POST")) {

            $arrayOfValues = explode(',', $request->input("selectedValues")); //Lấy tất cả id đc chọn

            foreach ($arrayOfValues as $arrayOfValue) {

                $product = Product::onlyTrashed()->find($arrayOfValue); //Tìm product đã xóa

                if ($product) {
                    $product->restore(); //Khôi phục
                } else {
                    return redirect()->back()->with("error", "Không tìm thấy sản phẩm");
                }
            }

            return redirect()->back()->with("success", "Khôi phục thành công");
        }

        return redirect()->back()->with("error", "Khôi phục thất bại");
    }
}
