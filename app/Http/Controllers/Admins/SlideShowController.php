<?php

namespace App\Http\Controllers\Admins;

use App\Models\Product;
use App\Models\SlideShow;
use Illuminate\Http\Request;
use App\Models\SlideShowGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $classActive = "Slide Show";

    public function index()
    {
        $slideShows = SlideShow::orderByDesc('created_at')->paginate(8);
        $template = 'admins.slideshows.list'; //Tạo biến template để include vào content của layout

        return view('admins.layout', [
            'title' => 'Danh Sách Slide Show',
            'template' => $template,
            'classActive' => $this->classActive,
            'slideShows' => $slideShows
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderByDesc('created_at')->get();
        $template = "admins.slideshows.create";

        return view('admins.layout', [
            'title' => 'Tạo Mới Slide Show',
            'template' => $template,
            'classActive' => $this->classActive,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'name' => 'required|max:100',
                    'link' => 'required|not_in:0|exists:products,id',
                    'link2' => 'required|not_in:0|exists:products,id',
                    'link3' => 'required|not_in:0|exists:products,id',
                    "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
                    "image2" => "required|image|mimes:jpeg,png,jpg|max:2048",
                    "image3" => "required|image|mimes:jpeg,png,jpg|max:2048",
                    'galleries' => 'required',
                    'galleries.*' => 'image|mimes:jpeg,png,jpg|max:2048',

                ],
                [
                    'name.required' => 'Không được để trống tên slide show',
                    'name.max' => 'Tên slide show quá dài',
                    'link' => 'Không được để trống link',
                    'link.exists' => 'Link không hợp lệ',
                    'link2' => 'Không được để trống link',
                    'link2.exists' => 'Link không hợp lệ',
                    'link3' => 'Không được để trống link',
                    'link3.exists' => 'Link không hợp lệ',
                    'image.required' => 'Không được để trống ảnh',
                    'image.image' => 'Ảnh sai định dạng',
                    'image.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'image.max' => 'Dung lượng ảnh quá lớn',
                    'image2.required' => 'Không được để trống ảnh',
                    'image2.image' => 'Ảnh sai định dạng',
                    'image2.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'image2.max' => 'Dung lượng ảnh quá lớn',
                    'image3.required' => 'Không được để trống ảnh',
                    'image3.image' => 'Ảnh sai định dạng',
                    'image3.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'image3.max' => 'Dung lượng ảnh quá lớn',
                    'galleries.required' => 'Không được để trống ảnh slide show',
                    'galleries.*.image' => 'Định dạng ảnh không chính xác',
                    'galleries.*.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'galleries.*.max' => 'Dung lượng ảnh quá lớn'
                ]
            );

            $image = $request->file('image')->store('uploads/sideshows/images', "public");
            $image2 = $request->file('image2')->store('uploads/sideshows/images', "public");
            $image3 = $request->file('image3')->store('uploads/sideshows/images', "public");

            $slideShow = SlideShow::create([
                'name' => $request->input('name'),
                'image_one' => $image,
                'link_one' => $request->input('link'),
                'image_two' => $image2,
                'link_two' => $request->input('link2'),
                'image_three' => $image3,
                'link_three' => $request->input('link3'),
            ]);

            foreach ($request->file('galleries') as $gallery) {
                $image = $gallery->store('uploads/sideshows/galleries/slide_show_' . $slideShow->id, "public");
                SlideShowGallery::create([
                    'image' => $image,
                    'slide_show_id' => $slideShow->id
                ]);
            }

            SlideShow::where('id', '<>', $slideShow->id)->update(['active' => 'off']);

            return redirect()->route('slide-show.index')->with("success", "Thêm mới slide show thành công thành công");
        }
        return redirect()->back()->with("error", "Thêm mới slide show thất bại");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slideShow = SlideShow::find($id); //Lấy slideShow hiện tại

        if ($slideShow) {
            $products = Product::orderByDesc('created_at')->get();

            $template = "admins.slideshows.edit";

            return view('admins.layout', [
                'title' => 'Sửa Slide Show',
                'template' => $template,
                'classActive' => $this->classActive,
                'slideShow' => $slideShow,
                'products' => $products
            ]);
        }

        return redirect()->back()->with('error', 'Không tìm thấy hãng');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $request->validate(
                [
                    'name' => 'required|max:100',
                    'link' => 'required|not_in:0|exists:products,id',
                    'link2' => 'required|not_in:0|exists:products,id',
                    'link3' => 'required|not_in:0|exists:products,id',
                    "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
                    "image2" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
                    "image3" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
                    'galleries.*' => 'image|mimes:jpeg,png,jpg|max:2048',

                ],
                [
                    'name.required' => 'Không được để trống tên slide show',
                    'name.max' => 'Tên slide show quá dài',
                    'link' => 'Không được để trống link',
                    'link.exists' => 'Link không hợp lệ',
                    'link2' => 'Không được để trống link',
                    'link2.exists' => 'Link không hợp lệ',
                    'link3' => 'Không được để trống link',
                    'link3.exists' => 'Link không hợp lệ',
                    'image.image' => 'Ảnh sai định dạng',
                    'image.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'image.max' => 'Dung lượng ảnh quá lớn',
                    'image2.image' => 'Ảnh sai định dạng',
                    'image2.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'image2.max' => 'Dung lượng ảnh quá lớn',
                    'image3.image' => 'Ảnh sai định dạng',
                    'image3.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'image3.max' => 'Dung lượng ảnh quá lớn',
                    'galleries.*.image' => 'Định dạng ảnh không chính xác',
                    'galleries.*.mimes' => 'Ảnh phải là jpeg, png, jpg',
                    'galleries.*.max' => 'Dung lượng ảnh quá lớn'
                ]
            );

            $slideShow = SlideShow::find($id);

            if ($slideShow) {
                if ($request->hasFile('image')) {
                    if ($slideShow->image_one && Storage::disk('public')->exists($slideShow->image_one)) {
                        Storage::disk('public')->delete($slideShow->image_one);
                    }
                    $image = $request->file('image')->store("uploads/sideshows/images", "public");
                } else {
                    $image = $slideShow->image_one;
                }
                if ($request->hasFile('image2')) {
                    if ($slideShow->image_two && Storage::disk('public')->exists($slideShow->image_two)) {
                        Storage::disk('public')->delete($slideShow->image_two);
                    }
                    $image2 = $request->file('image')->store("uploads/sideshows/images", "public");
                } else {
                    $image2 = $slideShow->image_two;
                }
                if ($request->hasFile('image3')) {
                    if ($slideShow->image_three && Storage::disk('public')->exists($slideShow->image_three)) {
                        Storage::disk('public')->delete($slideShow->image_three);
                    }
                    $image3 = $request->file('image')->store("uploads/sideshows/images", "public");
                } else {
                    $image3 = $slideShow->image_three;
                }

                $slideShow->name = $request->input('name');
                $slideShow->image_one = $image;
                $slideShow->link_one = $request->input('link');
                $slideShow->image_two = $image2;
                $slideShow->link_two = $request->input('link2');
                $slideShow->image_three = $image3;
                $slideShow->link_three = $request->input('link3');
                $slideShow->save();

                if ($request->input('delete_galleries')) {
                    foreach ($request->input('delete_galleries') as $key => $image) {
                        $gallery = SlideShowGallery::find($key);
                        if ($gallery) {
                            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) { //Kiểm tra có image trong csdl và public hay không
                                Storage::disk('public')->delete($gallery->image); //Nếu có thì xóa ảnh đấy
                            }
                            $gallery->delete();
                        }
                    }
                }

                if ($request->hasFile('galleries')) {
                    foreach ($request->file('galleries') as $gallery) {
                        $image = $gallery->store('uploads/sideshows/galleries/slide_show_' . $slideShow->id, "public");
                        SlideShowGallery::create([
                            'image' => $image,
                            'slide_show_id' => $slideShow->id
                        ]);
                    }
                }

                foreach ($request->input('linkProducts') as $index => $link) {
                    $slideShowGallery = SlideShowGallery::find($index);
                    if ($slideShowGallery && $link != 0 && $link != "") {
                        $slideShowGallery->link = $link;
                        $slideShowGallery->save();
                    }
                }

                return redirect()->back()->with("success", "Sửa slide show thành công thành công");
            }

            return redirect()->back()->with("error", "Không tìm thấy slide show");
        }
        return redirect()->back()->with("error", "Sửa slide show thất bại");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slideShow = SlideShow::find($id);

        if ($slideShow) {

            Storage::disk('public')->delete($slideShow->image_one);
            Storage::disk('public')->delete($slideShow->image_two);
            Storage::disk('public')->delete($slideShow->image_three);
            foreach ($slideShow->slideShowGalleries as $slideShowGallery) {
                Storage::disk('public')->delete($slideShowGallery->image);
            }

            $slideShow->delete();
            
            return redirect()->back()->with("success", "Xóa slide show thành công");
        }

        return redirect()->back()->with("error", "Không tìm thấy slide show");
    }

    public function apply(string $id)
    {
        $slideShow = SlideShow::find($id);
        if ($slideShow) {
            $slideShow->active = "on";
            $slideShow->save();
            SlideShow::where('id', '<>', $slideShow->id)->update(['active' => 'off']);
            return redirect()->back()->with("success", "Sủa dụng slide show thành công");
        }
        return redirect()->back()->with("error", "Không tìm thấy slide show");
    }
}
