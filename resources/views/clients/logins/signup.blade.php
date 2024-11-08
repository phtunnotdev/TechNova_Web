@include('clients.components.breadcrumb')
<!-- LogIn Page Start -->
<div class="log-in ptb-45">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- Returning Customer Start -->
            <div class="col-md-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10 custom-title text-center">Đăng ký</h3>
                        <form action="{{route('client.store.signup')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" name="name" value="{{old('name')}}" placeholder="Nhập vào họ tên" class="form-control {{$errors->has('name') ? 'is-invalid' : ""}}">
                                @if ($errors->has("name"))
                                <p class="text-danger mt-1">{{$errors->first("name")}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{old('email')}}" placeholder="Nhập vào email" class="form-control {{$errors->has('email') ? 'is-invalid' : ""}}">
                                @if ($errors->has("email"))
                                <p class="text-danger mt-1">{{$errors->first("email")}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="password-eye">
                                <input type="password" id="password" name="password" placeholder="Nhập vào mật khẩu" class="form-control {{$errors->has('password') ? 'is-invalid' : ""}} bg-none">
                                <i class="fa fa-eye {{$errors->has('password') ? 'text-danger' : ""}}" id="togglePassword"></i>
                                </div>
                                @if ($errors->has("password"))
                                <p class="text-danger mt-1">{{$errors->first("password")}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <div class="password-eye">
                                <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Xác nhận mật khẩu" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ""}} bg-none">
                                <i class="fa fa-eye {{$errors->has('password_confirmation') ? 'text-danger' : ""}}" id="toggleConfirmPassword"></i>
                                </div>
                                @if ($errors->has("password_confirmation"))
                                <p class="text-danger mt-1">{{$errors->first("password_confirmation")}}</p>
                                @endif
                            </div>
                            <input type="submit" value="Đăng ký" class="return-customer-btn">
                        </form>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- LogIn Page End -->

{{-- Thêm js --}}
@section('script')
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Đổi biểu tượng mắt
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
document.getElementById('toggleConfirmPassword').addEventListener('click', function (e) {
    const passwordField = document.getElementById('confirmPassword');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Đổi biểu tượng mắt
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
</script>
@endsection