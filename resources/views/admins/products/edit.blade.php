<div class="container-xxl animated fadeInDown">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{$title}}</h4>
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
            </div>
        </div>
    </div>
    <form id="myForm" action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thông tin chung</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">ID</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$product->product_code}}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Ảnh <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="position-relative">
                                            <input class="form-control {{$errors->has("image") ? "is-invalid" : ""}}" name="image" type="file" onchange="showImage(event)">
                                            <img src="{{".".Storage::url($product->image)}}" class="image-style position-absolute" style="display: block" id="image" alt="image">
                                        </div>
                                        @if ($errors->has("image"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("image")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Mô tả ngắn</label>
                                    <div class="col-sm-10">
                                        <div id="editor">{!!old("short-description", $product->short_description)!!}</div>
                                        <textarea name="short-description" class="form-control" style="display: none">{!!old("short-description", $product->short_description)!!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Ảnh khác
                                    </label>
                                    <div class="col-sm-10">
                                      <div id="drag-drop-area" class="mb-1 {{$errors->has("galleries.*") ? "border border-danger rounded" : ""}}">
                                        <input type="file" name="galleries[]" accept="image/*,video/*" multiple style="display: none"/>
                                      </div>
                                      <p>Hình ảnh hiện tại <span class="text-danger">(Chọn để xóa)</span></p>
                                      @if ($errors->has("galleries.*"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("galleries.*")}}</p>
                                      @endif
                                      <div class="row g-1">
                                        @foreach ($product->galleries as $index => $gallery)
                                        <div class="col-2">
                                            <div class="position-relative">
                                            <img src="{{".".Storage::url($gallery->path)}}" class="w-100 rounded" alt="">
                                            <input class="position-absolute bottom-0 end-0" type="checkbox" name="delete_galleries[{{$gallery->id}}]" {{old('delete_galleries.'.$gallery->id) ? "checked" : ""}}>
                                            </div>
                                        </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-6">    
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Tên SP <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("name") ? "is-invalid" : ""}}" name="name" value="{{old('name', $product->name)}}" type="text" placeholder="Nhập vào họ tên">
                                        @if ($errors->has("name"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("name")}}</p>
                                        @endif
                                    </div>
                                </div>                                     
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Phân loại <span class="text-danger">*</span></label>
                                    <div class="col-sm-5">
                                        <select name="category" class="form-select {{$errors->has("category") ? "is-invalid" : ""}}">
                                            <option value="0">Danh Mục</option>
                                            @foreach ($categories as $category)
                                            <option {{old('category', $product->category->id) == $category->id ? "selected" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has("category"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("category")}}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="brand" class="form-select {{$errors->has("brand") ? "is-invalid" : ""}}">
                                            <option value="0">Hãng</option>
                                            @foreach ($brands as $brand)
                                            <option {{old('brand', $product->brand->id) == $brand->id ? "selected" : ""}} value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has("brand"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("brand")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Mô tả</label>
                                    <div class="col-sm-10">
                                        <div id="editor-2">{!!old("description", $product->description)!!}</div>
                                        <textarea  name="description" class="form-control" style="display: none">{!!old("description", $product->description)!!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-2"></div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-6 row">
                                                <label for="example-month-input" class="col-sm-auto col-form-label text-end">Hot</label>
                                                <div class="col-sm-12">
                                                    <div class="form-check form-switch form-switch-danger">
                                                        <input class="form-check-input" name="hot" type="checkbox" id="customSwitchDanger" {{$product->is_hot === "yes" ? "checked" : ""}}>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 row">
                                                <label for="example-month-input" class="col-sm-auto col-form-label text-end">Trạng thái</label>
                                                <div class="col-sm-12">
                                                    <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" name="status" type="checkbox" id="customSwitchSuccess" {{$product->status === "active" ? "checked" : ""}}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div><!--end col-->
                        </div> <!--end row-->
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col-->                                                       
    </div><!--end row-->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thông tin biến thể</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="attribute-container" class="w-100">
                                    <div class="{{$errors->has('images.'.$product->productVariants[0]->id) || $errors->has('colors.'.$product->productVariants[0]->id) || $errors->has('ssds.'.$product->productVariants[0]->id) || $errors->has('importPrices.'.$product->productVariants[0]->id) || $errors->has('listedPrices.'.$product->productVariants[0]->id) || $errors->has('prices.'.$product->productVariants[0]->id) || $errors->has('quantities.'.$product->productVariants[0]->id) ? "mb-1" : "mb-2"}} row attribute-item">
                                        <div class="col-sm-1 pe-0">
                                            <div class="position-relative">
                                                <input class="form-control" name="variants[{{$product->productVariants[0]->id}}]" type="hidden" value="variant">
                                                <input class="form-control {{$errors->has("images.0") ? "is-invalid" : ""}}" name="images[{{$product->productVariants[0]->id}}]" type="file" onchange="previewImage(this)">
                                                <img src="{{".".Storage::url($product->productVariants[0]->image)}}" class="image-style-variant position-absolute" style="display: block" alt="image">
                                            </div>
                                            @if ($errors->has("images.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("images.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="colors[{{$product->productVariants[0]->id}}]" class="form-select {{$errors->has("colors.".$product->productVariants[0]->id) ? "border-danger" : ""}}">
                                                <option value="0">Màu</option>
                                                @foreach ($colors as $color)
                                                <option {{old('colors.'.$product->productVariants[0]->id, $product->productVariants[0]->color->id) == $color->id ? "selected" : ""}} value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("colors.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("colors.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="ssds[{{$product->productVariants[0]->id}}]" class="form-select {{$errors->has("ssds.".$product->productVariants[0]->id) ? "border-danger" : ""}}">
                                                <option value="0">SSD</option>
                                                @foreach ($ssds as $ssd)
                                                <option {{old('ssds.'.$product->productVariants[0]->id, $product->productVariants[0]->ssd->id) == $ssd->id ? "selected" : ""}} value="{{$ssd->id}}">{{$ssd->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("ssds.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("ssds.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="importPrices[{{$product->productVariants[0]->id}}]" class="form-control {{$errors->has("importPrices.".$product->productVariants[0]->id) ? "is-invalid" : ""}}" value="{{old('importPrices.'.$product->productVariants[0]->id, $product->productVariants[0]->import_price)}}" placeholder="Giá nhập">
                                            @if ($errors->has("importPrices.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("importPrices.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="listedPrices[{{$product->productVariants[0]->id}}]" class="form-control {{$errors->has("listedPrices.".$product->productVariants[0]->id) ? "is-invalid" : ""}}" value="{{old('listedPrices.'.$product->productVariants[0]->id, $product->productVariants[0]->listed_price)}}" placeholder="Giá niêm yết">
                                            @if ($errors->has("listedPrices.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("listedPrices.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="prices[{{$product->productVariants[0]->id}}]" class="form-control {{$errors->has("prices.".$product->productVariants[0]->id) ? "is-invalid" : ""}}" value="{{old('prices.'.$product->productVariants[0]->id, $product->productVariants[0]->price)}}" placeholder="Giá bán">
                                            @if ($errors->has("prices.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("prices.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="quantities[{{$product->productVariants[0]->id}}]" class="form-control {{$errors->has("quantities.".$product->productVariants[0]->id) ? "is-invalid" : ""}}" value="{{old('quantities.'.$product->productVariants[0]->id, $product->productVariants[0]->quantity)}}" placeholder="Số lượng">
                                            @if ($errors->has("quantities.".$product->productVariants[0]->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("quantities.".$product->productVariants[0]->id)}}</p>  
                                            @endif
                                        </div>
                                    </div>
                                    @foreach($product->productVariants as $index => $productVariant)
                                    @if($index > 0)
                                    <div class="{{$errors->has('images.'. $productVariant->id) || $errors->has('colors.'. $productVariant->id) || $errors->has('ssds.'. $productVariant->id) || $errors->has('importPrices.'. $productVariant->id) || $errors->has('listedPrices.'. $productVariant->id) || $errors->has('prices.'. $productVariant->id) || $errors->has('quantities.'. $productVariant->id) ? "mb-1" : "mb-2"}} row attribute-item">
                                        <div class="col-sm-1 pe-0">
                                            <div class="position-relative">
                                                <input class="form-control" name="variants[{{$productVariant->id}}]" type="hidden" value="variant">
                                                <input class="form-control {{$errors->has("images.". $productVariant->id) ? "is-invalid" : ""}}" name="images[{{$productVariant->id}}]" type="file" onchange="previewImage(this)">
                                                <img src="{{".".Storage::url($productVariant->image)}}" class="image-style-variant position-absolute" style="display: block" alt="image">
                                            </div>
                                            @if ($errors->has("images.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("images.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="colors[{{$productVariant->id}}]" class="form-select {{$errors->has("colors.". $productVariant->id) ? "border-danger" : ""}}">
                                                <option value="0">Màu</option>
                                                @foreach ($colors as $color)
                                                <option {{old('colors.' . $productVariant->id, $productVariant->color->id) == $color->id ? "selected" : ""}} value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("colors.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("colors.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="ssds[{{$productVariant->id}}]" class="form-select {{$errors->has("ssds.". $productVariant->id) ? "border-danger" : ""}}">
                                                <option value="0">SSD</option>
                                                @foreach ($ssds as $ssd)
                                                <option {{old('ssds.' . $productVariant->id, $productVariant->ssd->id) == $ssd->id ? "selected" : ""}} value="{{$ssd->id}}">{{$ssd->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("ssds.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("ssds.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="importPrices[{{$productVariant->id}}]" class="form-control {{$errors->has("importPrices.". $productVariant->id) ? "is-invalid" : ""}}" value="{{old('importPrices.' . $productVariant->id, $productVariant->import_price)}}" placeholder="Giá nhập">
                                            @if ($errors->has("importPrices.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("importPrices.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="listedPrices[{{$productVariant->id}}]" class="form-control {{$errors->has("listedPrices.". $productVariant->id) ? "is-invalid" : ""}}" value="{{old('listedPrices.' . $productVariant->id, $productVariant->listed_price)}}" placeholder="Giá niêm yết">
                                            @if ($errors->has("listedPrices.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("listedPrices.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="prices[{{$productVariant->id}}]" class="form-control {{$errors->has("prices.". $productVariant->id) ? "is-invalid" : ""}}" value="{{old('prices.' . $productVariant->id, $productVariant->price)}}" placeholder="Giá bán">
                                            @if ($errors->has("prices.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("prices.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="quantities[{{$productVariant->id}}]" class="form-control {{$errors->has("quantities.". $productVariant->id) ? "is-invalid" : ""}}" value="{{old('quantities.' . $productVariant->id, $productVariant->quantity)}}" placeholder="Số lượng">
                                            @if ($errors->has("quantities.". $productVariant->id))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("quantities.". $productVariant->id)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 flex-grow-1 d-flex justify-content-center align-items-center">
                                            <i class="fas fa-xmark text-white cursor-pointer bg-danger remove-attribute-btn"></i>
                                        </div>
                                    </div>    
                                    @endif
                                    @endforeach
                                    @if(old('variants'))
                                    @foreach(old('variants') as $index => $variant)
                                    @if($index > $productVariant->id)
                                    <div class="{{$errors->has('images.'. $index) || $errors->has('colors.'. $index) || $errors->has('ssds.'. $index) || $errors->has('importPrices.'. $index) || $errors->has('listedPrices.'. $index) || $errors->has('prices.'. $index) || $errors->has('quantities.'. $index) ? "mb-1" : "mb-2"}} row attribute-item">
                                        <div class="col-sm-1 pe-0">
                                            <div class="position-relative">
                                                <input class="form-control" name="variants[]" type="hidden" value="variant">
                                                <input class="form-control {{$errors->has("images.". $index) ? "is-invalid" : ""}}" name="images[]" type="file" onchange="previewImage(this)">
                                                <img src="" class="image-style-variant position-absolute" alt="image">
                                            </div>
                                            @if ($errors->has("images.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("images.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="colors[]" class="form-select {{$errors->has("colors.". $index) ? "border-danger" : ""}}">
                                                <option value="0">Màu</option>
                                                @foreach ($colors as $color)
                                                <option {{old('colors.' . $index) == $color->id ? "selected" : ""}} value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("colors.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("colors.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="ssds[]" class="form-select {{$errors->has("ssds.". $index) ? "border-danger" : ""}}">
                                                <option value="0">SSD</option>
                                                @foreach ($ssds as $ssd)
                                                <option {{old('ssds.' . $index) == $ssd->id ? "selected" : ""}} value="{{$ssd->id}}">{{$ssd->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("ssds.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("ssds.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="importPrices[]" class="form-control {{$errors->has("importPrices.". $index) ? "is-invalid" : ""}}" value="{{old('importPrices.' . $index)}}" placeholder="Giá nhập">
                                            @if ($errors->has("importPrices.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("importPrices.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="listedPrices[]" class="form-control {{$errors->has("listedPrices.". $index) ? "is-invalid" : ""}}" value="{{old('listedPrices.' . $index)}}" placeholder="Giá niêm yết">
                                            @if ($errors->has("listedPrices.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("listedPrices.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="prices[]" class="form-control {{$errors->has("prices.". $index) ? "is-invalid" : ""}}" value="{{old('prices.' . $index)}}" placeholder="Giá bán">
                                            @if ($errors->has("prices.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("prices.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="quantities[]" class="form-control {{$errors->has("quantities.". $index) ? "is-invalid" : ""}}" value="{{old('quantities.' . $index)}}" placeholder="Số lượng">
                                            @if ($errors->has("quantities.". $index))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("quantities.". $index)}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 flex-grow-1 d-flex justify-content-center align-items-center">
                                            <i class="fas fa-xmark text-white cursor-pointer bg-danger remove-attribute-btn"></i>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                <div class="mt-3 mb-2">
                                    <button type="button" id="add-attribute-btn" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Thêm biến thể</button>
                                </div>
                                <div class="text-end mb-3">
                                    <button type="reset" class="btn btn-danger mr1">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>         
                            </div><!--end col-->
                        </div> <!--end row-->
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col-->                                                       
    </div><!--end row-->
    </form>
</div>

{{-- Thêm js --}}
@section('script')
<script src="assets/libs/quill/quill.js"></script>
<script src="assets/js/pages/form-editor.init.js"></script>
<script src="assets/libs/uppy/uppy.legacy.min.js"></script>
<script src="assets/js/pages/file-upload.init.js"></script>
<script>
    function showImage(event){
     const image = document.getElementById('image');
     const file = event.target.files[0];
     const render = new FileReader();
     render.onload = function () {
        image.src = render.result;
        image.style.display = "block";
     }
     if(file){
        render.readAsDataURL(file);
     }
    }
    const myForm = document.getElementById('myForm');
    const addAttributeBtn = document.getElementById('add-attribute-btn');
    const attributeContainer = document.getElementById('attribute-container');
    const attributeTemplate = `<div class="mb-2 row attribute-item">
                                        <div class="col-sm-1 pe-0">
                                            <div class="position-relative">
                                                <input class="form-control" name="variants[]" type="hidden" value="variant">
                                                <input class="form-control" name="images[]" type="file" onchange="previewImage(this)">
                                                <img src="" class="image-style-variant position-absolute" alt="image">
                                            </div>
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="colors[]" class="form-select">
                                                <option value="0">Màu</option>
                                                @foreach ($colors as $color)
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="ssds[]" class="form-select">
                                                <option value="0">SSD</option>
                                                @foreach ($ssds as $ssd)
                                                <option value="{{$ssd->id}}">{{$ssd->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="importPrices[]" class="form-control" placeholder="Giá nhập">
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="listedPrices[]" class="form-control" placeholder="Giá niêm yết">
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="prices[]" class="form-control" placeholder="Giá bán">
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="quantities[]" class="form-control" placeholder="Số lượng">
                                        </div>
                                        <div class="col-sm-auto ps-1 flex-grow-1 d-flex justify-content-center align-items-center">
                                            <i class="fas fa-xmark text-white cursor-pointer bg-danger remove-attribute-btn"></i>
                                        </div>
                                    </div>`;
    addAttributeBtn.addEventListener('click', function () {
        attributeContainer.insertAdjacentHTML('beforeend', attributeTemplate);
    });
    attributeContainer.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-attribute-btn')) {
            const attributeItem = e.target.closest('.attribute-item');
            attributeItem.classList.add('fade-out');
            setTimeout(function() {
                attributeItem.remove();
            }, 200);
        }
    });

    function previewImage(input) {
    // Lấy thẻ img bên cạnh thẻ input
    const imgElement = input.nextElementSibling;
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        // Khi file đã được đọc xong
        reader.onload = function (e) {
            imgElement.src = e.target.result; // Cập nhật src của thẻ img
            imgElement.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]); // Đọc file dưới dạng Data URL
    } else {
        imgElement.src = ''; // Đặt lại src nếu không có file
    }
}    
</script>
@endsection