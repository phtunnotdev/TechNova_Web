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
    <form id="myForm" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
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
                                        <input class="form-control" type="text" value="Auto string" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Ảnh <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="position-relative">
                                            <input class="form-control {{$errors->has("image") ? "is-invalid" : ""}}" name="image" type="file" onchange="showImage(event)">
                                            <img src="" class="image-style position-absolute" id="image" alt="image">
                                        </div>
                                        @if ($errors->has("image"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("image")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Mô tả ngắn</label>
                                    <div class="col-sm-10">
                                        <div id="editor" style="height: 100px;">{!!old("short-description")!!}</div>
                                        <textarea name="short-description" class="form-control" style="display: none">{!!old("short-description")!!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Ảnh khác</label>
                                    <div class="col-sm-10">
                                      <div id="drag-drop-area" class="{{$errors->has("galleries.*") ? "border border-danger rounded" : ""}}">
                                        <input type="file" name="galleries[]" accept="image/*,video/*" multiple style="display: none"/>
                                      </div>
                                      @if ($errors->has("galleries.*"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("galleries.*")}}</p>
                                      @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-month-input" class="col-sm-2 col-form-label text-end">Hot</label>
                                    <div class="col-sm-10 d-flex align-items-center">
                                        <div class="form-check form-switch form-switch-danger">
                                            <input class="form-check-input" name="hot" type="checkbox" id="customSwitchDanger">
                                        </div>
                                    </div>
                                </div>         
                            </div><!--end col-->
                            <div class="col-lg-6">    
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Tên SP <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("name") ? "is-invalid" : ""}}" name="name" value="{{old('name')}}" type="text" placeholder="Nhập vào họ tên">
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
                                            <option {{old('category') == $category->id ? "selected" : ""}} value="{{$category->id}}">{{$category->name}}</option>
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
                                            <option {{old('brand') == $brand->id ? "selected" : ""}} value="{{$brand->id}}">{{$brand->name}}</option>
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
                                        <div id="editor-2">{!!old("description")!!}</div>
                                        <textarea  name="description" class="form-control" style="display: none">{!!old("description")!!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-month-input" class="col-sm-2 col-form-label text-end">Trạng thái</label>
                                    <div class="col-sm-10 d-flex align-items-center">
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" name="status" type="checkbox" id="customSwitchSuccess" checked>
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
                                    <div class="{{$errors->has('images.0') || $errors->has('colors.0') || $errors->has('ssds.0') || $errors->has('importPrices.0') || $errors->has('listedPrices.0') || $errors->has('prices.0') || $errors->has('quantities.0') ? "mb-1" : "mb-2"}} row attribute-item">
                                        <div class="col-sm-1 pe-0">
                                            <div class="position-relative">
                                                <input class="form-control" name="variants[]" type="hidden" value="variant">
                                                <input class="form-control {{$errors->has("images.0") ? "is-invalid" : ""}}" name="images[]" type="file" onchange="previewImage(this)">
                                                <img src="" class="image-style-variant position-absolute" alt="image">
                                            </div>
                                            @if ($errors->has("images.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("images.0")}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="colors[]" class="form-select {{$errors->has("colors.0") ? "border-danger" : ""}}">
                                                <option value="0">Màu</option>
                                                @foreach ($colors as $color)
                                                <option {{old('colors.0') == $color->id ? "selected" : ""}} value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("colors.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("colors.0")}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-auto ps-1 pe-0">
                                            <select name="ssds[]" class="form-select {{$errors->has("ssds.0") ? "border-danger" : ""}}">
                                                <option value="0">SSD</option>
                                                @foreach ($ssds as $ssd)
                                                <option {{old('ssds.0') == $ssd->id ? "selected" : ""}} value="{{$ssd->id}}">{{$ssd->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has("ssds.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("ssds.0")}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="importPrices[]" class="form-control {{$errors->has("importPrices.0") ? "is-invalid" : ""}}" value="{{old('importPrices.0')}}" placeholder="Giá nhập">
                                            @if ($errors->has("importPrices.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("importPrices.0")}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="listedPrices[]" class="form-control {{$errors->has("listedPrices.0") ? "is-invalid" : ""}}" value="{{old('listedPrices.0')}}" placeholder="Giá niêm yết">
                                            @if ($errors->has("listedPrices.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("listedPrices.0")}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="prices[]" class="form-control {{$errors->has("prices.0") ? "is-invalid" : ""}}" value="{{old('prices.0')}}" placeholder="Giá bán">
                                            @if ($errors->has("prices.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("prices.0")}}</p>  
                                            @endif
                                        </div>
                                        <div class="col-sm-2 ps-1 pe-0">
                                            <input type="text" name="quantities[]" class="form-control {{$errors->has("quantities.0") ? "is-invalid" : ""}}" value="{{old('quantities.0')}}" placeholder="Số lượng">
                                            @if ($errors->has("quantities.0"))
                                             <p class="text-danger mb-0 mt1 fs10">{{$errors->first("quantities.0")}}</p>  
                                            @endif
                                        </div>
                                    </div>
                                    @if (old('variants'))
                                    @foreach(old('variants') as $index => $variant)
                                    @if($index > 0)
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
                                    <button type="submit" class="btn btn-primary">Tạo mới</button>
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