<div class="container-xxl animated fadeInDown">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between">                      
                            <h4 class="card-title">{{$title}}</h4><h6><span class="fw-normal">Cập nhật gần nhất lúc</span> {{date('H:i:s d/m/Y', strtotime($user->updated_at))}}</h6>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">ID</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$user->user_code}}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("email") ? "is-invalid" : ""}}" name="email" value="{{old('email', $user->email)}}" type="text" placeholder="example@gmail.com">
                                        @if ($errors->has("email"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("email")}}</p>
                                        @endif
                                    </div>
                                </div> 
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Mật khẩu <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="password-eye">
                                            <input class="form-control {{$errors->has("password") ? "is-invalid" : ""}} bg-none" id="password" value="{{$user->show_password}}" name="password" type="password" placeholder="Nhập vào mật khẩu">
                                            <i class="fa fa-eye {{$errors->has("password") ? "text-danger" : ""}}" id="togglePassword"></i>
                                        </div>
                                        @if ($errors->has("password"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("password")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Địa chỉ</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control {{$errors->has("address") ? "is-invalid" : ""}}" name="address" rows="4" placeholder="Nhập vào địa chỉ">{{old('address', $user->address)}}</textarea>
                                        @if ($errors->has("address"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("address")}}</p>
                                        @endif
                                    </div>
                                </div>                          
                            </div><!--end col-->
                            <div class="col-lg-6">    
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Họ tên <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("name") ? "is-invalid" : ""}}" name="name" value="{{old('name', $user->name)}}" type="text" placeholder="Nhập vào họ tên">
                                        @if ($errors->has("name"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("name")}}</p>
                                        @endif
                                    </div>
                                </div>                                     
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Điện thoại</label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("phone") ? "is-invalid" : ""}}" name="phone" value="{{old('phone', $user->phone)}}" type="text" placeholder="Nhập vào số điện thoại">
                                        @if ($errors->has("phone"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("phone")}}</p>
                                        @endif
                                    </div>
                                </div> 
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Avatar</label>
                                    <div class="col-sm-10">
                                        <div class="position-relative">
                                            <input class="form-control {{$errors->has("image") ? "is-invalid" : ""}}" name="image" type="file" onchange="showImage(event)">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" class="image-style position-absolute" style="display: block" id="image" alt="image">
                                        </div>
                                        @if ($errors->has("image"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("image")}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-month-input" class="col-sm-2 col-form-label text-end">Trạng thái</label>
                                    <div class="col-sm-10 d-flex align-items-center">
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" name="status" type="checkbox" id="customSwitchSuccess" {{$user->status == 'active' ? 'checked' : ''}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mb-3">
                                    <button type="reset" class="btn btn-danger mr1">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    document.getElementById('togglePassword').addEventListener('click', function (e) {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Đổi biểu tượng mắt
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
</script>
@endsection