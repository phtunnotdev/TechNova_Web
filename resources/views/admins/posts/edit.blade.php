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
    <form id="myForm" action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
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
                                <label class="col-sm-2 col-form-label text-end">Tiêu đề <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control {{$errors->has("title") ? "is-invalid" : ""}}" name="title" value="{{old('title', $post->title)}}" type="text" placeholder="Nhập vào tiêu đề">
                                    @if ($errors->has("title"))
                                    <p class="text-danger mt-1 mb-0">{{$errors->first("title")}}</p>
                                    @endif
                                </div>
                            </div>  
                        </div><!--end col-->
                        <div class="col-lg-6">    
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label text-end">Ảnh<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="position-relative">
                                        <input class="form-control {{$errors->has("image") ? "is-invalid" : ""}}" name="image" type="file" onchange="showImage(event)">
                                        <img src="{{".".Storage::url($post->image)}}" class="image-style position-absolute" style="display: block" id="image" alt="image">
                                    </div>
                                    @if ($errors->has("image"))
                                    <p class="text-danger mt-1 mb-0">{{$errors->first("image")}}</p>
                                    @endif
                                </div>
                            </div>
                             
                            
                        </div><!--end col-->

                        <div class="col-lg-12">    
                            <div class="mb-3 row">
                                <label class="col-sm-1 col-form-label text-end">Nội dung <span class="text-danger">*</span></label>
                                <div class="col-sm-11">
                                    <!-- Trình soạn thảo Quill -->
                                    <div id="editor">{!! old('content',  $post->content) !!}</div>
                                    <!-- Textarea ẩn -->
                                    <textarea name="content" class="form-control" style="display: none">{!! old('content', $post->content) !!}</textarea>
                                    @if ($errors->has("content"))
                                    <p class="text-danger mt-1 mb-0">{{$errors->first("content")}}</p>
                                    @endif
                                </div>
                            </div>
                            
                        </div><!--end col-->
                        <div class="text-end mb-3">
                            {{-- <button type="reset" class="btn btn-danger mr1">Reset</button> --}}
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
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
    
    const addAttributeBtn = document.getElementById('add-attribute-btn');
    const attributeContainer = document.getElementById('attribute-container');
   
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
<script>
    document.getElementById('myForm').addEventListener('submit', function (e) {
    var content = quill.root.innerHTML; // Lấy nội dung HTML từ Quill
    document.querySelector('textarea[name="content"]').value = content; // Đặt nội dung vào textarea ẩn
    console.log(content);  // Kiểm tra nội dung trước khi gửi
});

</script>
@endsection