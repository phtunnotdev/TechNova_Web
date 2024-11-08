<!-- Main Header Area Start Here -->
<header>
    <!-- Header Top Start Here -->
    <div class="header-top light-blue-bg">
      <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
          <div class="col">
            <!-- Header Top Left Start -->
            <div class="header-top-left text-center text-md-start">
              <ul>
                <li>
                  <span>Language:</span
                  ><a href="#"
                    ><img
                      src="templates/img/header/1.jpg"
                      alt="language-selector" />Tiếng Việt<i
                      class="ion-arrow-down-b"
                    ></i
                  ></a>
                </li>
                {{-- <li>
                  <span>Currency:</span
                  ><a href="#">USD $<i class="ion-arrow-down-b"></i></a>
                  <!-- Dropdown Start -->
                  <ul class="ht-dropdown">
                    <li><a href="#">English</a></li>
                    <li><a href="#">Français</a></li>
                  </ul>
                  <!-- Dropdown End -->
                </li> --}}
              </ul>
            </div>
            <!-- Header Top Left End -->
          </div>
          <div class="col">
            <!-- Header Top Right Start -->
            <div class="header-top-right text-center text-md-end">
              <ul>
                <li>
                    @if (Auth::user())
                     <img width="22px" class="border rounded-circle border-white" src="{{Auth::user()->image ? ".".Storage::url(Auth::user()->image) : "assets/images/users/avatar-default.png"}}" alt="">
                    @endif
                  <a href="{{Auth::user() ? route('client.account') : route('client.login')}}" class="ps-0">
                  {{Auth::user() ? Auth::user()->name : "Đăng nhập"}}
                 </a>
                </li>
                <li><a href="{{Auth::user() ? route('client.logout') : route('client.signup')}}" class="{{Auth::user() ? "text-danger" : ""}}">{{Auth::user() ? "Đăng xuất" : "Đăng ký"}}</a></li>
              </ul>
            </div>
            <!-- Header Top Right End -->
          </div>
        </div>
      </div>
      <!-- Container End -->
    </div>
    <!-- Header Top End Here -->
    <!-- Header Middle Start Here -->
    <div class="header-middle light-blue-bg ptb-35">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-12">
            <div class="logo mb-all-30">
              <a href="{{ route('client.index') }}"
                ><img src="templates/img/logo/logoshop.png" alt="logo-image"
              /></a>
            </div>
          </div>
          <!-- Categorie Search Box Start Here -->
          <div class="col-lg-6 col-md-12">
            <div class="categorie-search-box">
              <form action="#">
                <div class="form-group">
                  <select class="bootstrap-select" name="poscats">
                    <option value="0">Tất cả sản phẩm</option>
                    <option value="2">Electronics</option>

                  </select>
                </div>
                <input
                  type="text"
                  name="search"
                  placeholder="Tìm kiếm sản phẩm ... "
                />
                <button><i class="ion-ios-search"></i></button>
              </form>
            </div>
          </div>
          <!-- Categorie Search Box End Here -->
          <!-- Cart Box Start Here -->
          <div class="col-lg-3 col-md-12">
            <div class="cart-box mt-all-30">
              <ul
                class="d-flex justify-content-lg-end justify-content-center align-items-center"
              >
              <li>
                <a class="wish-list-item" href="{{ route('client.wishlist') }}">
                  <i class="ion-android-favorite-outline"></i>
                  <span class="total-pro">
                    {{ Auth::check() ? DB::table('wishlist_items')->where('user_id', auth()->id())->count() : '' }}
                  </span>
                </a>
              </li>
              
              <li>
                <a href="{{ route('client.cart') }}">
                  <i class="ion-bag"></i>
                  <span class="total-pro">
                    {{ Auth::check() ? DB::table('carts')->where('user_id', auth()->id())->count() : '' }}
                  </span>
                </a>
              </li>
              
              </ul>
            </div>
          </div>
          <!-- Cart Box End Here -->
        </div>
        <!-- Row End -->
      </div>
      <!-- Container End -->
    </div>
    <!-- Header Middle End Here -->
    <!-- Header Bottom Start Here -->
    <div class="header-bottom dark-blue-bg header-sticky">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-9 col-lg-9 col-md-12">
            <nav class="d-none d-lg-block">
              <ul class="header-bottom-list d-flex">
                <li class="active">
                  <a href="{{route('client.index')}}"
                    >Trang chủ<i ></i
                  ></a>
                  <!-- Home Version Dropdown Start -->
                  {{-- <ul class="ht-dropdown">
                    <li><a href="index.html">Home Version 1</a></li>
                    <li><a href="index-2.html">Home Version 2</a></li>
                    <li><a href="index-3.html">Home Version 3</a></li>
                    <li><a href="index-4.html">Home Version 4</a></li>
                  </ul> --}}
                  <!-- Home Version Dropdown End -->
                </li>

                <li>
                    <a href="{{route('client.shop')}}">Sản phẩm</a>
                    <!-- Bắt đầu Danh sách Dropdown -->
                    {{-- <ul class="ht-dropdown dropdown-style-two">
                      <li><a href="#">chi tiết sản phẩm</a></li>
                      <li><a href="compare.html">so sánh</a></li>
                      <li><a href="#">giỏ hàng</a></li>
                      <li><a href="#">thanh toán</a></li>
                      <li><a href="wishlist.html">danh sách yêu thích</a></li>
                    </ul> --}}
                    <!-- Kết thúc Danh sách Dropdown -->
                <li>
                  <a href="{{route('client.blog')}}"
                    >blog<i class="fa fa-angle-down"></i
                  ></a>
                </li>
                <li>
                    <a href="#">Liên hệ<i class="fa fa-angle-down"></i></a>
                    <!-- Bắt đầu Danh sách Dropdown -->
                    <ul class="ht-dropdown dropdown-style-two">
                      <li><a href="contact.html">liên hệ với chúng tôi</a></li>
                      <li><a href="register.html">đăng ký</a></li>
                      <li><a href="login.html">đăng nhập</a></li>
                      <li><a href="forgot-password.html">quên mật khẩu</a></li>
                      {{-- <li><a href="404.html">404</a></li> --}}
                    </ul>
                    <!-- Kết thúc Danh sách Dropdown -->
                  </li>
                <li><a href="about.html">Về chúng tôi</a></li>
              </ul>
            </nav>
            <div class="mobile-menu d-block d-lg-none">
              <nav>
                <ul>
                  <li>
                    <a href="index.html">home</a>
                    <!-- Home Version Dropdown Start -->
                    {{-- <ul>
                      <li><a href="index.html">Home Version 1</a></li>
                      <li><a href="index-2.html">Home Version 2</a></li>
                      <li><a href="index-3.html">Home Version 3</a></li>
                      <li><a href="index-4.html">Home Version 4</a></li>
                    </ul> --}}
                    <!-- Home Version Dropdown End -->
                  </li>
                  <li>
                    <a href="shop.html">cửa hàng</a>
                    <!-- Bắt đầu Danh sách Dropdown Di Động -->
                    <ul>
                      <li><a href="product.html">chi tiết sản phẩm</a></li>
                      <li><a href="compare.html">so sánh</a></li>
                      <li><a href="cart.html">giỏ hàng</a></li>
                      <li><a href="checkout.html">thanh toán</a></li>
                      <li><a href="wishlist.html">danh sách yêu thích</a></li>
                    </ul>
                    <!-- Kết thúc Danh sách Dropdown Di Động -->
                  </li>
                  <li>
                    <a href="blog.html">Blog</a>
                  </li>
                  <li>
                    <a href="#">pages</a>
                    <!-- Mobile Menu Dropdown Start -->
                    <ul>
                      <li><a href="register.html">register</a></li>
                      <li><a href="login.html">sign in</a></li>
                      <li>
                        <a href="forgot-password.html">forgot password</a>
                      </li>
                      <li><a href="404.html">404</a></li>
                    </ul>
                    <!-- Mobile Menu Dropdown End -->
                  </li>
                  <li><a href="about.html">about us</a></li>
                  <li><a href="contact.html">contact us</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 text-right">
            <span class="header-right"
              ><i class="ion-ios-telephone"></i>Hotline:
              <span class="header-helpline">+088 12 345 678</span></span
            >
          </div>
        </div>
        <!-- Row End -->
      </div>
      <!-- Container End -->
    </div>
    <!-- Header Bottom End Here -->
    <!-- Mobile Vertical Menu Start Here -->
    <div class="container d-block d-lg-none">
      <div class="vertical-menu mt-30">
        <span class="categorie-title mobile-categorei-menu"
          >all Categories <i class="fa fa-angle-down"></i
        ></span>
        <nav>
          <div
            id="cate-mobile-toggle"
            class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden"
          >
            <ul>
              <li class="has-sub">
                <a href="#">Electronics</a>
                <ul class="category-sub">
                  <li><a href="shop.html">Cords and Cables</a></li>
                  <li><a href="shop.html">gps accessories</a></li>
                  <li><a href="shop.html">Microphones</a></li>
                  <li><a href="shop.html">Wireless Transmitters</a></li>
                </ul>
                <!-- category submenu end-->
              </li>
              <li class="has-sub">
                <a href="#">Fashion</a>
                <ul class="category-sub">
                  <li><a href="shop.html">Fashion one</a></li>
                  <li><a href="shop.html">Fashion two</a></li>
                  <li><a href="shop.html">Fashion three</a></li>
                  <li><a href="shop.html">Fashion Four</a></li>
                </ul>
                <!-- category submenu end-->
              </li>
              <li class="has-sub">
                <a href="#">Home & Kitchen</a>
                <ul class="category-sub">
                  <li><a href="shop.html">kithen one</a></li>
                  <li><a href="shop.html">kithen two</a></li>
                  <li><a href="shop.html">kithen three</a></li>
                  <li><a href="shop.html">kithen four</a></li>
                </ul>
                <!-- category submenu end-->
              </li>
              <li class="has-sub">
                <a href="#">Phones & Tablets</a>
                <ul class="category-sub">
                  <li><a href="shop.html">phone one</a></li>
                  <li><a href="shop.html">Tablet two</a></li>
                  <li><a href="shop.html">Tablet three</a></li>
                  <li><a href="shop.html">phone four</a></li>
                </ul>
                <!-- category submenu end-->
              </li>
              <li class="has-sub">
                <a href="#">TV & Video</a>
                <ul class="category-sub">
                  <li><a href="shop.html">smart tv</a></li>
                  <li><a href="shop.html">real video</a></li>
                  <li><a href="shop.html">Microphones</a></li>
                  <li><a href="shop.html">Wireless Transmitters</a></li>
                </ul>
                <!-- category submenu end-->
              </li>
              <li><a href="#">Beauty</a></li>
              <li><a href="#">Sport & tourisim</a></li>
              <li><a href="#">Meat & Seafood</a></li>
            </ul>
          </div>
          <!-- category-menu-end -->
        </nav>
      </div>
    </div>
    <!-- Mobile Vertical Menu Start End -->
  </header>
  <!-- Main Header Area End Here -->
