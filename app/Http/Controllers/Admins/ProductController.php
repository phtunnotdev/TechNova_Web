<?php

namespace App\Http\Controllers\Admins;

use App\Models\Ssd;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admins\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $classActive = "Sản Phẩm";

    public function index()
    {
        $products = Product::with('category')  // Nối thêm bảng category
            ->withMin('productVariants', 'price')  // Lấy giá min của productVariants
            ->withMax('productVariants', 'price')  // Lấy giá max của productVariants
            ->withSum('productVariants', 'quantity') // Lấy tổng số lượng
            ->orderByDesc('created_at')
            ->paginate(8);

        $template = 'admins.products.list'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
            'title' => 'Danh Sách Sản Phẩm',
            'template' => $template,
            'classActive' => $this->classActive,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::orderBy('created_at')->get();
        $ssds = Ssd::orderBy('created_at')->get();
        $brands = Brand::orderBy('created_at')->get();
        $categories = Category::orderBy('created_at')->get();

        $template = "admins.products.create";

        return view('admins.layout', [
            'title' => 'Tạo Mới Sản Phẩm',
            'template' => $template,
            'classActive' => $this->classActive,
            'colors' => $colors,
            'ssds' => $ssds,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->isMethod('POST')) {

            if (!Category::where("id", $request->input('category'))->exists() || !Brand::where("id", $request->input('brand'))->exists()) {
                return redirect()->back()->with('error', 'Thêm mới sản phẩm thất bại');
            }

            if ($request->hasFile('images')) {
                if (count($request->file('images')) !== count($request->input('variants'))) {
                    return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ ảnh biến thể');
                }
            } else {
                return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ ảnh biến thể');
            }

            //Thêm sản phẩm
            $product_code = "PR-" . Str::random(5); //Tạo một mã bất kỳ
            $userExists = Product::where('product_code', $product_code)->exists(); //Xem mã có bị trùng không

            if ($userExists) { //Nếu trùng thông báo lỗi
                return redirect()->back()->with('error', 'Tạo mới sản phẩm thất bại');
            }

            $image = $request->file('image')->store('uploads/products', "public");

            $product = Product::create([
                "product_code" => $product_code,
                "name" => $request->input('name'),
                "image" => $image,
                "short_description" => $request->input('short-description'),
                "description" => $request->input('description'),
                "status" => $request->input('status') ? "active" : "banned",
                "is_hot" => $request->input('hot') ? "yes" : "no",
                "category_id" => $request->input('category'),
                "brand_id" => $request->input('brand'),
                "user_id" => Auth::id()
            ]);

            //Thêm nhiều ảnh
            if ($request->hasFile('galleries')) {
                foreach ($request->file('galleries') as $file) {
                    // Kiểm tra file có phải là ảnh
                    if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                        $path = $file->store('uploads/galleries/product_' . $product->id, 'public');
                        $type = "image";
                    }
                    // Kiểm tra file có phải là video
                    elseif (in_array($file->getMimeType(), ['video/mp4'])) {
                        $path = $file->store('uploads/videos', 'public');
                        $type = "video";
                    }

                    Gallery::create([
                        'path' => $path,
                        'type' => $type,
                        'product_id' => $product->id,
                    ]);
                }
            }

            //Thêm biến thể
            if ($request->input('variants')) {
                foreach ($request->input('variants') as $index => $variant) {

                    if ($request->file('images')[$index]) {
                        $imageVariant = $request->file('images')[$index]->store('uploads/product_variants/product_' . $product->id, "public");
                    }

                    ProductVariant::create([
                        'image' => $imageVariant,
                        'import_price' => $request->input('importPrices')[$index],
                        'listed_price' => $request->input('listedPrices')[$index],
                        'price' => $request->input('prices')[$index],
                        'quantity' => $request->input('quantities')[$index],
                        'color_id' => $request->input('colors')[$index],
                        'ssd_id' => $request->input('ssds')[$index],
                        'product_id' => $product->id
                    ]);
                }
            }

            return redirect()->route('product.index')->with("success", "Thêm mới sản phẩm thành công");
        }

        return redirect()->back()->with("error", "Thêm mới sản phẩm thất bại");
    }



    public function show(string $id)
    {
        // Lấy thông tin sản phẩm cùng với category, reviews và user liên quan, cùng với các thông tin thống kê
        $product = Product::with('category', 'reviews.user') // Nối bảng reviews và user để lấy thông tin đánh giá
            ->withMin('productVariants', 'price')  // Lấy giá min của productVariants
            ->withMax('productVariants', 'price')  // Lấy giá max của productVariants
            ->withSum('productVariants', 'quantity') // Tính tổng số lượng của các biến thể sản phẩm
            ->withCount('reviews') // Đếm tổng số đánh giá cho sản phẩm
            ->withAvg('reviews', 'star') // Tính điểm đánh giá trung bình cho sản phẩm
            ->find($id);

        if ($product) {
            // Tính doanh thu
            $totalRevenue = $product->productVariants->sum(function ($variant) {
                return $variant->price * $variant->quantity; // Doanh thu từ từng biến thể
            });

            // Lượt bán được tính từ tổng số lượng của các biến thể
            $totalSales = $product->product_variants_sum_quantity;

            // Lấy số lượt xem hiện tại
            $viewsCount = $product->view;

            // Tạo biến template để include vào content của layout
            $template = 'admins.products.detail';

            return view('admins.layout', [
                'title' => 'Chi Tiết Sản Phẩm',
                'template' => $template,
                'classActive' => $this->classActive,
                'product' => $product, // Truyền sản phẩm vào view
                'totalRevenue' => $totalRevenue, // Doanh thu
                'totalSales' => $totalSales, // Lượt bán
                'viewsCount' => $viewsCount // Lượt xem
            ]);
        }

        // Nếu không tìm thấy sản phẩm, trả về trang trước đó với thông báo lỗi
        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if ($product) {

            $categories = Category::orderBy("created_at")->get();
            $brands = Brand::orderBy("created_at")->get();
            $colors = Color::orderBy("created_at")->get();
            $ssds = Ssd::orderBy("created_at")->get();

            $template = 'admins.products.edit'; //Tạo biến template để include vào content của layout

            return view('admins.layout', [
                'title' => 'Sửa Sản Phẩm',
                'template' => $template,
                'classActive' => $this->classActive,
                'product' => $product,
                'categories' => $categories,
                'brands' => $brands,
                'colors' => $colors,
                'ssds' => $ssds
            ]);
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {

            if (!Category::where("id", $request->input('category'))->exists() || !Brand::where("id", $request->input('brand'))->exists()) {
                return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại');
            }

            $product = Product::find($id);
            if ($product) {
                //Cật nhật sản phẩm
                if ($request->hasFile('image')) {  //Nếu có ảnh
                    if ($product->image && Storage::disk('public')->exists($product->image)) { //Kiểm tra có image trong csdl và public hay không
                        Storage::disk('public')->delete($product->image); //Nếu có thì xóa ảnh đấy
                    }
                    $image = $request->file('image')->store("uploads/products", "public"); //Lưu ảnh mới
                } else {
                    $image = $product->image; //Giũ lại ảnh cũ
                }
                $product->name = $request->input('name');
                $product->image = $image;
                $product->category_id = $request->input('category');
                $product->brand_id = $request->input('brand');
                $product->short_description = $request->input('short-description');
                $product->is_hot = $request->input('hot') ? 'yes' : 'no';
                $product->status = $request->input('status') ? 'active' : 'banned';
                $product->description = $request->input('description');
                $product->save();

                //Cật nhật galleries
                if ($request->input('delete_galleries')) {
                    foreach ($request->input('delete_galleries') as $key => $file) {
                        $gallery = Gallery::find($key);
                        if ($gallery) {
                            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) { //Kiểm tra có path trong csdl và public hay không
                                Storage::disk('public')->delete($gallery->path); //Nếu có thì xóa ảnh đấy
                            }
                            $gallery->delete();
                        }
                    }
                }

                if ($request->hasFile('galleries')) {
                    foreach ($request->file('galleries') as $file) {
                        if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                            $path = $file->store('uploads/galleries/product_' . $product->id, 'public');
                            $type = "image";
                        }
                        // Kiểm tra file có phải là video
                        elseif (in_array($file->getMimeType(), ['video/mp4'])) {
                            $path = $file->store('uploads/videos', 'public');
                            $type = "video";
                        }

                        Gallery::create([
                            'path' => $path,
                            'type' => $type,
                            'product_id' => $product->id,
                        ]);
                    }
                }

                //Cập nhật biến thể
                foreach ($product->productVariants as $productVariant) {
                    if (isset($request->input('variants')[$productVariant->id])) {
                        if ($request->hasFile('images') && isset($request->file('images')[$productVariant->id])) {  //Nếu có ảnh
                            if ($productVariant->image && Storage::disk('public')->exists($productVariant->image)) { //Kiểm tra có image trong csdl và public hay không
                                Storage::disk('public')->delete($productVariant->image); //Nếu có thì xóa ảnh đấy
                            }
                            $image = $request->file('images')[$productVariant->id]->store("uploads/product_variants/product_" . $product->id, "public"); //Lưu ảnh mới
                        } else {
                            $image = $productVariant->image; //Giũ lại ảnh cũ
                        }

                        $productVariant->image = $image;
                        $productVariant->import_price = $request->input('importPrices')[$productVariant->id];
                        $productVariant->listed_price = $request->input('listedPrices')[$productVariant->id];
                        $productVariant->price = $request->input('prices')[$productVariant->id];
                        $productVariant->quantity = $request->input('quantities')[$productVariant->id];
                        $productVariant->color_id = $request->input('colors')[$productVariant->id];
                        $productVariant->ssd_id = $request->input('ssds')[$productVariant->id];
                        $productVariant->save();
                    } else {
                        if ($productVariant->image && Storage::disk('public')->exists($productVariant->image)) { //Kiểm tra có image trong csdl và public hay không
                            Storage::disk('public')->delete($productVariant->image); //Nếu có thì xóa ảnh đấy
                        }
                        $productVariant->delete();
                    }
                }

                //Thêm biến thể mới
                $productVariantIds = $product->productVariants->pluck('id')->toArray();
                $newArray = [];
                foreach ($request->input('variants') as $index => $variant) {
                    if (!in_array($index, $productVariantIds)) {
                        $newArray[$index] = $variant;
                    }
                }

                foreach ($newArray as $index => $arr) {
                    if ($request->file('images')[$index]) {
                        $imageVariant = $request->file('images')[$index]->store('uploads/product_variants/product_' . $product->id, "public");
                    }

                    ProductVariant::create([
                        'image' => $imageVariant,
                        'import_price' => $request->input('importPrices')[$index],
                        'listed_price' => $request->input('listedPrices')[$index],
                        'price' => $request->input('prices')[$index],
                        'quantity' => $request->input('quantities')[$index],
                        'color_id' => $request->input('colors')[$index],
                        'ssd_id' => $request->input('ssds')[$index],
                        'product_id' => $product->id
                    ]);
                }
                return redirect()->back()->with("success", "Cật nhật sản phẩm thành công");
            }

            return redirect()->back()->with("error", "Không tìm thấy sản phẩm");
        }

        return redirect()->back()->with("error", "Cập nhật sản phẩm thất bại");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return redirect()->back()->with("success", "Chuyển vào thùng rác thành công");
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
    }
}
