@include('clients.components.breadcrumb')
<!-- LogIn Page Start -->
<div class="log-in ptb-45">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- Returning Customer Start -->
            <div class="col-md-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10 custom-title text-center">Đăng nhập</h3>
                        <form action="{{route('client.store')}}" method="POST">
                            @csrf
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
                                    <input type="password" name="password" id="password" placeholder="Nhập vào mật khẩu" class="form-control {{$errors->has('password') ? 'is-invalid' : ""}} bg-none">
                                    <i class="fa fa-eye {{$errors->has('password') ? 'text-danger' : ""}}" id="togglePassword"></i>
                                </div>
                                @if ($errors->has("password"))
                                <p class="text-danger mt-1">{{$errors->first("password")}}</p>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between"><div class="d-flex align-items-center" style="font-size: 13px">
                                {{-- <input type="checkbox" class="me-1"><span>Nghi nhớ</span> --}}
                            </div><p class="lost-password mt-0"><a href="forgot-password.html">Quên mật khẩu ?</a></p></div>
                            <input type="submit" value="Đăng nhập" class="return-customer-btn">
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
</script>
@endsection