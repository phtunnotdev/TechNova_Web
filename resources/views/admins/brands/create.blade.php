<div class="container-xxl animated fadeInDown">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">{{$title}}</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Tên hãng <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("name") ? "is-invalid" : ""}}" name="name" value="{{old('name')}}" type="text" placeholder="Nhập vào tên hãng">
                                        @if ($errors->has("name"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("name")}}</p>
                                        @endif
                                    </div>
                                </div>                 
                            </div><!--end col-->
                            <div class="col-lg-12">                            
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Ảnh hãng</label>
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
                                <div class="text-end mb-3">
                                    <button type="reset" class="btn btn-danger mr1">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                                </div>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </form>
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col-->                                                       
    </div><!--end row-->
</div>

{{-- Thêm js --}}
@section('script')
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
</script>
@endsection