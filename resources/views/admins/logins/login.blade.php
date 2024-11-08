<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
  <!-- Mirrored from mannatthemes.com/rizz/default/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Sep 2024 09:30:44 GMT -->
  <head>
    @include('admins.components.head')
  </head>

  <!-- Top Bar Start -->
  <body>
    <div class="container-xxl animated fadeInDown">
      <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 mx-auto">
                <div class="card">
                  <div
                    class="card-body p-0 bg-black auth-header-box rounded-top"
                  >
                    <div class="text-center p-3">
                      <a href="index.html" class="logo logo-admin">
                        <img
                          src="assets/images/logo-sm.png"
                          height="50"
                          alt="logo"
                          class="auth-logo"
                        />
                      </a>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <form
                      class="my-4"
                      method="post"
                      action="{{route("admin.store")}}"
                    >
                    @csrf
                      <div class="form-group mb-2">
                        <label class="form-label"
                          >Email</label
                        >
                        <input
                          type="text"
                          class="form-control {{$errors->has("email") ? "is-invalid" : ""}}" 
                          name="email"
                          value="{{old('email')}}"
                          placeholder="Nhập vào email"
                        />
                        @if ($errors->has("email"))
                        <p class="text-danger mb-0 mt-1 fs-12">{{$errors->first("email")}}</p>
                        @endif
                      </div>
                      <!--end form-group-->

                      <div class="form-group">
                        <label class="form-label"
                          >Mật khẩu</label
                        >
                        <div class="password-eye">
                          <input class="form-control {{$errors->has("password") ? "is-invalid" : ""}} bg-none" id="password" name="password" type="password" placeholder="Nhập vào mật khẩu">
                          <i class="fa fa-eye {{$errors->has("password") ? "text-danger" : ""}}" id="togglePassword"></i>
                        </div>
                        @if ($errors->has("password"))
                        <p class="text-danger mb-0 mt-1 fs-12">{{$errors->first("password")}}</p>
                        @endif
                      </div>
                      <!--end form-group-->

                      <div class="form-group row mt-3">
                        <div class="col-sm-6">
                          {{-- <div
                            class="form-check form-switch form-switch-success"
                          >
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="customSwitchSuccess"
                            />
                            <label
                              class="form-check-label"
                              for="customSwitchSuccess"
                              >Ghi nhớ</label
                            >
                          </div> --}}
                        </div>
                        <!--end col-->
                        <div class="col-sm-6 text-end">
                          <a
                            href="auth-recover-pw.html"
                            class="text-muted font-13"
                            ><i class="dripicons-lock"></i> Quên mật khẩu ?</a
                          >
                        </div>
                        <!--end col-->
                      </div>
                      <!--end form-group-->

                      <div class="form-group mb-0 row">
                        <div class="col-12">
                          <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">
                              Đăng Nhập <i class="fas fa-sign-in-alt ms-1"></i>
                            </button>
                          </div>
                        </div>
                        <!--end col-->
                      </div>
                      <!--end form-group-->
                    </form>
                    <!--end form-->
                  </div>
                  <!--end card-body-->
                </div>
                <!--end card-->
              </div>
              <!--end col-->
            </div>
            <!--end row-->
          </div>
          <!--end card-body-->
        </div>
        <!--end col-->
      </div>
      <!--end row-->
    </div>
    <!-- container -->

    {{-- Thêm js --}}
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
  </body>
  <!--end body-->

  <!-- Mirrored from mannatthemes.com/rizz/default/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Sep 2024 09:30:44 GMT -->
</html>
