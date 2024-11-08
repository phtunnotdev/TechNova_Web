<!-- Categorie Menu & Slider Area Start Here -->
<div class="main-page-banner ptb-30">
  <div class="container">
      <div class="row">
          <!-- Vertical Menu Start Here -->
          <div class="col-xl-3 col-lg-4 d-none d-lg-block">
              <div class="vertical-menu mb-all-30">
                  <span class="categorie-title">Danh Mục <i class="fa fa-angle-down"></i></span>
                  <nav>
                      <ul class="vertical-menu-list">
                          @foreach ($categories as $category)
                              <li>
                                  <a href="{{ route('client.shop') }}"><span><img
                                              src="templates/img/vertical-menu/1.png"
                                              alt="menu-icon" /></span>{{ $category->name }}
                                  </a>
                              </li>
                          @endforeach
                      </ul>
                  </nav>
              </div>
          </div>
          <!-- Vertical Menu End Here -->
          <!-- Slider Area Start Here -->
          <div class="col-xl-6 col-lg-8">
              <div class="slider-wrapper theme-default">
                  <!-- Slider Background  Image Start-->
                  <div id="slider" class="nivoSlider">
                      @foreach ($slideShow->slideShowGalleries as $slideShowGallery)
                          <a
                              href="{{ $slideShowGallery->link ? route('client.product.detail', $slideShowGallery->link) : '' }}"><img
                                  src="{{ '.' . Storage::url($slideShowGallery->image) }}"
                                  data-thumb="{{ '.' . Storage::url($slideShowGallery->image) }}" alt="slide" /></a>
                      @endforeach
                  </div>
                  <!-- Slider Background  Image Start-->
                  <div class="slider-progress"></div>
              </div>
          </div>
          <!-- Slider Area End Here -->
          <!-- Right Slider Banner Start Here -->
          <div class="col-xl-3 col-lg-12">
              <div class="right-sider-banner">
                  <div class="single-banner">
                      <a href="{{ route('client.product.detail', $slideShow->link_one) }}"><img
                              src="{{ '.' . Storage::url($slideShow->image_one) }}" alt=""
                              style="aspect-ratio: 16 / 9; object-fit: cover" /></a>
                  </div>
                  <div class="single-banner">
                      <a href="{{ route('client.product.detail', $slideShow->link_two) }}"><img
                              src="{{ '.' . Storage::url($slideShow->image_two) }}" alt=""
                              style="aspect-ratio: 16 / 9; object-fit: cover" /></a>
                  </div>
                  <div class="single-banner">
                      <a href="{{ route('client.product.detail', $slideShow->link_three) }}"><img
                              src="{{ '.' . Storage::url($slideShow->image_three) }}" alt=""
                              style="aspect-ratio: 16 / 9; object-fit: cover" /></a>
                  </div>
              </div>
          </div>
          <!-- Right Slider Banner End Here -->
      </div>
      <!-- Row End -->
  </div>
  <!-- Container End -->
</div>
<!-- Categorie Menu & Slider Area End Here -->
<!-- Brand Banner Area Start Here -->
<div class="main-brand-banner pb-30">
  <div class="container">
      <!-- Brand Banner Start -->
      <div class="brand-banner owl-carousel">
          <div class="single-brand">
              <a href="#"><img class="img" src="templates/img/brand/1.jpg" alt="brand-image" /></a>
          </div>
          <div class="single-brand">
              <a href="#"><img src="templates/img/brand/2.jpg" alt="brand-image" /></a>
          </div>
          <div class="single-brand">
              <a href="#"><img src="templates/img/brand/3.jpg" alt="brand-image" /></a>
          </div>
          <div class="single-brand">
              <a href="#"><img src="templates/img/brand/4.jpg" alt="brand-image" /></a>
          </div>
          <div class="single-brand">
              <a href="#"><img src="templates/img/brand/5.jpg" alt="brand-image" /></a>
          </div>
          <div class="single-brand">
              <a href="#"><img src="templates/img/brand/6.jpg" alt="brand-image" /></a>
          </div>
          <div class="single-brand">
              <a href="#"><img src="templates/img/brand/7.jpg" alt="brand-image" /></a>
          </div>
      </div>
      <!-- Brand Banner End -->
  </div>
  <!-- Container End -->
</div>
<!-- Brand Banner Area End Here -->
<!-- Hot Deal Products Start Here -->
<div class="hot-deal-products pb-45">
  <div class="container">
      <!-- Post Title Start -->
      <div class="post-title">
          <h2>Sản phẩm mới</h2>
      </div>
      <!-- Post Title End -->
      <div class="row">
          <!-- Hot Deal Left Banner Start -->
          <div class="col-xl-3 col-lg-4 col-md-5">
              <div class="single-banner">
                  <a href="shop.html"><img src="templates/img/banner/4.jpg" alt="" /></a>
              </div>
          </div>
          <!-- Hot Deal Left Banner End -->
          <!-- Hot Deal Product Activation Start -->
          <div class="col-xl-9 col-lg-8 col-md-7">
              <div class="main-hot-deal">
                  <!-- Hot Deal Product Active Start -->
                  <div class="hot-deal-active owl-carousel">
                      <!-- Single Product Start -->
                      @foreach ($newProducts as $newProduct)
                          <div class="single-product">
                              <!-- Product Image Start -->
                              <div class="pro-img w-100 d-flex align-items-center" style="aspect-ratio: 1/1">
                                  <a href="{{ route('client.product.detail', $newProduct->id) }}">
                                      <img class="primary-img" src="{{ '.' . Storage::url($newProduct->image) }}"
                                          alt="single-product" />
                                      <img class="secondary-img"
                                          src="{{ '.' . Storage::url($newProduct->galleries->first()->path) }}"
                                          alt="single-product" />
                                  </a>
                                  {{-- <div class="countdown bg-main text-white" data-countdown="2024/12/01"></div> --}}
                              </div>
                              <!-- Product Image End -->
                              <!-- Product Content Start -->
                              <div class="pro-content">
                                  <div class="pro-info">
                                      <h4><a href="product.html">{{ $newProduct->name }}</a></h4>
                                      <div class="product-rating">
                                        @php
                                            $averageRating = $newProduct->reviews_avg_star ?? 0; // Điểm đánh giá trung bình
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars;
                                        @endphp

                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <i class="fa-solid fa-star" style="color: gold;"></i>
                                                <!-- Sao đầy -->
                                            @elseif ($i == $fullStars + 1 && $halfStar >= 0.5)
                                                <i class="fa-solid fa-star-half-alt"
                                                    style="color: gold;"></i> <!-- Nửa sao -->
                                            @else
                                                <i class="fa-regular fa-star"
                                                    style="color: gray;"></i> <!-- Sao rỗng -->
                                            @endif
                                        @endfor
                                    </div>
                                      <p>
                                          <span class="price"
                                              style="font-size: 14px">{{ number_format($newProduct->product_variants_min_price, 0, '', '.') }}đ
                                              -
                                              {{ number_format($newProduct->product_variants_max_price, 0, '', '.') }}đ</span>
                                      </p>
                                  </div>
                                  <div class="pro-actions">
                                      <div class="actions-primary">
                                          <a href="{{ route('client.product.detail', $newProduct->id) }}"
                                              class="px-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                              title="Xem chi tiết">Xem chi tiết</a>
                                      </div>
                                      <div class="actions-secondary">
                                        @if (in_array($newProduct->id, $wishlistedProductIds))
                                            <!-- Hiển thị nút đã yêu thích -->
                                            <button type="button" class="whish-btn-active" style="color: red;" title="Đã thêm vào yêu thích">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        @else
                                            <!-- Hiển thị nút thêm vào yêu thích -->
                                            <form action="{{ route('client.wishlist.add', $newProduct->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" data-bs-toggle="tooltip" class="whish-btn" data-bs-placement="top" title="Yêu thích">
                                                    <i class="fa fa-heart-o"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                  </div>
                              </div>
                              <!-- Product Content End -->
                              {{-- <span class="sticker-new">mới</span> --}}
                              {{-- <span class="sticker-sale">-5%</span> --}}
                          </div>
                      @endforeach
                      <!-- Single Product End -->
                  </div>
                  <!-- Hot Deal Product Active End -->
              </div>
          </div>
          <!-- Hot Deal Product Activation End -->
      </div>
      <!-- Row End -->
  </div>
  <!-- Container End -->
</div>
<!-- Hot Deal Products End Here -->
<!-- Big Banner Start Here -->
<div class="big-banner pb-45">
  <div class="container">
      <div class="single-banner">
          <img src="templates/img/banner/5.jpg" alt="" />
      </div>
  </div>
  <!-- Container End -->
</div>
<!-- Big Banner End Here -->
<!-- Electronics Products Area Start Here -->
<div class="electronics-product pb-45">
  <div class="container">
      <div class="row">
          <!-- Electronics Banner Start -->
          <div class="col-xl-3 col-lg-4 col-md-5">
              <!-- Post Title Start -->
              <div class="post-title">
                  <h2>
                      <i class="ion-ios-game-controller-b-outline"></i>Sản phẩm nổi bật
                  </h2>
              </div>
              <!-- Post Title End -->
              <div class="single-banner">
                  <a href="shop.html"><img src="templates/img/banner/6.jpg" alt="" /></a>
              </div>
          </div>
          <!-- Electronics Banner End -->
          <div class="col-xl-9 col-lg-8 col-md-7">
              <div class="main-product-tab-area">
                  <!-- Nav tabs -->
                  <ul class="nav tabs-area" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" data-bs-toggle="tab" href="#camera">Điện thoại</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="tab" href="#gamepad">Laptop</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="tab" href="#d-camera">Tivi</a>
                      </li>
                  </ul>
                  <!-- Tab Contetn Start -->
                  <div class="tab-content">
                      <div id="camera" class="tab-pane fade show active">
                          <!-- Electronics Product Activation Start Here -->
                          <div class="electronics-pro-active owl-carousel">
                              <!-- Double Product Start -->
                              @foreach ($featuredProducts as $product)
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                            <img class="primary-img" src="{{ '.' . Storage::url($product->image) }}"
                                            alt="single-product" />
                                        <img class="secondary-img"
                                            src="{{ '.' . Storage::url($product->galleries->first()->path) }}"
                                            alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">{{$product->name}}</a>
                                          </h4>
                                          <div class="product-rating">
                                            @php
                                                $averageRating = $product->reviews_avg_star ?? 0; // Điểm đánh giá trung bình
                                                $fullStars = floor($averageRating);
                                                $halfStar = $averageRating - $fullStars;
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $fullStars)
                                                    <i class="fa-solid fa-star" style="color: gold;"></i>
                                                    <!-- Sao đầy -->
                                                @elseif ($i == $fullStars + 1 && $halfStar >= 0.5)
                                                    <i class="fa-solid fa-star-half-alt"
                                                        style="color: gold;"></i> <!-- Nửa sao -->
                                                @else
                                                    <i class="fa-regular fa-star"
                                                        style="color: gray;"></i> <!-- Sao rỗng -->
                                                @endif
                                            @endfor
                                        </div>
                                          <p> <span class="price"
                                            style="font-size: 14px">{{ number_format($newProduct->product_variants_min_price, 0, '', '.') }}đ
                                            -
                                            {{ number_format($newProduct->product_variants_max_price, 0, '', '.') }}đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Add to Cart">Xem chi tiết</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a href="product.html">
                                          <img class="primary-img" src="{{ '.' . Storage::url($product->image) }}"
                                          alt="single-product" />
                                      <img class="secondary-img"
                                          src="{{ '.' . Storage::url($product->galleries->first()->path) }}"
                                          alt="single-product" />
                                        </a>
                                        <span class="sticker-new">mới</span>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content">
                                        <h4>
                                            <a href="product.html">{{$product->name}}</a>
                                        </h4>
                                        <div class="product-rating">
                                          @php
                                              $averageRating = $product->reviews_avg_star ?? 0; // Điểm đánh giá trung bình
                                              $fullStars = floor($averageRating);
                                              $halfStar = $averageRating - $fullStars;
                                          @endphp

                                          @for ($i = 1; $i <= 5; $i++)
                                              @if ($i <= $fullStars)
                                                  <i class="fa-solid fa-star" style="color: gold;"></i>
                                                  <!-- Sao đầy -->
                                              @elseif ($i == $fullStars + 1 && $halfStar >= 0.5)
                                                  <i class="fa-solid fa-star-half-alt"
                                                      style="color: gold;"></i> <!-- Nửa sao -->
                                              @else
                                                  <i class="fa-regular fa-star"
                                                      style="color: gray;"></i> <!-- Sao rỗng -->
                                              @endif
                                          @endfor
                                      </div>
                                        <p> <span class="price"
                                          style="font-size: 14px">{{ number_format($newProduct->product_variants_min_price, 0, '', '.') }}đ
                                          -
                                          {{ number_format($newProduct->product_variants_max_price, 0, '', '.') }}đ</span></p>
                                        <div class="pro-actions">
                                            <div class="actions-primary">
                                                <a href="cart.html" class="px-1 w-auto" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Add to Cart">Xem chi tiết</a>
                                            </div>
                                            <div class="actions-secondary">
                                                <a href="product.html" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Favorite"><i
                                                        class="fa fa-heart-o"></i></a>
                                                <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#myModal"><i class="fa fa-search"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->  
                              @endforeach
                          </div>
                          <!-- Electronics Product Activation End Here -->
                      </div>
                  </div>
                  <!-- Tab Content End -->
              </div>
              <!-- main-product-tab-area-->
          </div>
      </div>
      <!-- Row End -->
  </div>
  <!-- Container End -->
</div>
<!-- Electronics Products Area End Here -->
{{-- <!-- Fashion Products Area Start Here -->
<div class="fashion pb-45">
  <div class="container">
      <div class="row">
          <!-- Electronics Banner Start -->
          <div class="col-xl-3 col-lg-4 col-md-5">
              <!-- Post Title Start -->
              <div class="post-title">
                  <h2>
                      <i class="ion-tshirt-outline" aria-hidden="true"></i>Sản phẩm chất lượng
                  </h2>
              </div>
              <!-- Post Title End -->
              <div class="single-banner">
                  <a href="shop.html"><img src="templates/img/banner/10.jpg" alt="" /></a>
              </div>
          </div>
          <!-- Electronics Banner End -->
          <div class="col-xl-9 col-lg-8 col-md-7">
              <div class="main-product-tab-area">
                  <!-- Nav tabs -->
                  <ul class="nav tabs-area" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" data-bs-toggle="tab" href="#camera2">Điện thoại</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="tab" href="#gamepad2">Laptop</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="tab" href="#d-camera2">Tivi</a>
                      </li>
                  </ul>
                  <!-- Tab Contetn Start -->
                  <div class="tab-content">
                      <div id="camera2" class="tab-pane fade show active">
                          <!-- Electronics Product Activation Start Here -->
                          <div class="electronics-pro-active owl-carousel">
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/8.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/7.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/11.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/12.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4><a href="product.html">iPhone 15</a></h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">15.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/13.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/11.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                          <span class="sticker-sale">-8%</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4><a href="product.html">iPhone 15</a></h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/23.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/22.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/15.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/14.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/29.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/30.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">15.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                          </div>
                          <!-- Electronics Product Activation End Here -->
                      </div>
                      <!-- #camera End Here -->
                      <div id="gamepad2" class="tab-pane fade">
                          <!-- Electronics Product Activation Start Here -->
                          <div class="electronics-pro-active owl-carousel">
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/8.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/7.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/11.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/12.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4><a href="product.html">iPhone 15</a></h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">15.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/13.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/11.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                          <span class="sticker-sale">-8%</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4><a href="product.html">iPhone 15</a></h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/23.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/22.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/15.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/14.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/29.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/30.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">15.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                          </div>
                          <!-- Electronics Product Activation End Here -->
                      </div>
                      <!-- #gmaepad End Here -->
                      <div id="d-camera2" class="tab-pane fade">
                          <!-- Electronics Product Activation Start Here -->
                          <div class="electronics-pro-active owl-carousel">
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/8.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/7.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/11.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/12.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4><a href="product.html">iPhone 15</a></h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">15.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/13.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/11.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                          <span class="sticker-sale">-8%</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4><a href="product.html">iPhone 15</a></h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/23.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/22.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                              <!-- Double Product Start -->
                              <div class="double-product">
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/15.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/14.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                          </div>
                                          <p><span class="price">12.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                                  <!-- Single Product Start -->
                                  <div class="single-product">
                                      <!-- Product Image Start -->
                                      <div class="pro-img">
                                          <a href="product.html">
                                              <img class="primary-img" src="templates/img/products/29.jpg"
                                                  alt="single-product" />
                                              <img class="secondary-img" src="templates/img/products/30.jpg"
                                                  alt="single-product" />
                                          </a>
                                          <span class="sticker-new">mới</span>
                                      </div>
                                      <!-- Product Image End -->
                                      <!-- Product Content Start -->
                                      <div class="pro-content">
                                          <h4>
                                              <a href="product.html">iPhone 15</a>
                                          </h4>
                                          <div class="product-rating">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                              <i class="fa fa-star-o"></i>
                                          </div>
                                          <p><span class="price">15.000.000đ</span></p>
                                          <div class="pro-actions">
                                              <div class="actions-primary">
                                                  <a href="cart.html" class="px-1 w-auto"
                                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                                      title="Add to Cart">Thêm giỏ hàng</a>
                                              </div>
                                              <div class="actions-secondary">
                                                  <a href="product.html" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Favorite"><i
                                                          class="fa fa-heart-o"></i></a>
                                                  <span data-bs-toggle="tooltip" data-bs-placement="top">
                                                      <a href="#" data-bs-toggle="modal"
                                                          data-bs-target="#myModal"><i
                                                              class="fa fa-search"></i></a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Product Content End -->
                                  </div>
                                  <!-- Single Product End -->
                              </div>
                              <!-- Double Product End -->
                          </div>
                          <!-- Electronics Product Activation End Here -->
                      </div>
                      <!-- #d-camera End Here -->
                  </div>
                  <!-- Tab Content End -->
              </div>
              <!-- main-product-tab-area-->
          </div>
      </div>
      <!-- Row End -->
  </div>
  <!-- Container End -->
</div> --}}

<!-- Fashion Products Area End Here -->
<!-- Second Electronics Products Area Start Here -->
{{-- <div class="second-electronics-product pb-45">
  <div class="container">
    <div class="row">
      <!-- Electronics Banner Start -->
      <div class="col-xl-3 col-lg-4 col-md-5">
        <!-- Post Title Start -->
        <div class="post-title">
          <h2>
            <i class="ion-ios-game-controller-b-outline"></i>electronics
          </h2>
        </div>
        <!-- Post Title End -->
        <div class="single-banner">
          <a href="shop.html"><img src="templates/img/banner/8.jpg" alt="" /></a>
        </div>
      </div>
      <!-- Electronics Banner End -->
      <div class="col-xl-9 col-lg-8 col-md-7">
        <div class="main-product-tab-area">
          <!-- Nav tabs -->
          <ul class="nav tabs-area" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                data-bs-toggle="tab"
                href="#cameras"
                >Cameras</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#g-pad"
                >GamePad</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#digital-cam"
                >Digital Cameras</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#virtual"
                >Virtual Reality</a
              >
            </li>
          </ul>
          <!-- Tab Contetn Start -->
          <div class="tab-content">
            <div id="cameras" class="tab-pane fade show active">
              <!-- Electronics Product Activation Start Here -->
              <div class="electronics-pro-active owl-carousel">
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/8.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/7.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed Summer Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/12.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">printed dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/13.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                      <span class="sticker-sale">-8%</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">winter Dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/23.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/22.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printed chiffon dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/15.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/14.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed festvie Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/29.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/30.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printeddress dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
              </div>
              <!-- Electronics Product Activation End Here -->
            </div>
            <!-- #cameras End Here -->
            <div id="g-pad" class="tab-pane fade">
              <!-- Electronics Product Activation Start Here -->
              <div class="electronics-pro-active owl-carousel">
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/30.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/29.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed Summer Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/10.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/9.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">printed dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/14.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/15.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">winter Dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/12.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printed chiffon dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/21.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/22.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed festvie Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/7.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/8.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printeddress dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
              </div>
              <!-- Electronics Product Activation End Here -->
            </div>
            <!-- #g-pad End Here -->
            <div id="digital-cam" class="tab-pane fade">
              <!-- Electronics Product Activation Start Here -->
              <div class="electronics-pro-active owl-carousel">
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/18.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/19.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed Summer Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/32.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/33.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">printed dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/5.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/6.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">winter Dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/8.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/7.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printed chiffon dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/26.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/25.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed festvie Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/29.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/30.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printeddress dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
              </div>
              <!-- Electronics Product Activation End Here -->
            </div>
            <!-- #digital-cam End Here -->
            <div id="virtual" class="tab-pane fade">
              <!-- Electronics Product Activation Start Here -->
              <div class="electronics-pro-active owl-carousel">
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/8.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/7.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed Summer Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/12.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">printed dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/13.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                      <span class="sticker-sale">-8%</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">winter Dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/23.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/22.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printed chiffon dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/15.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/14.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed festvie Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/29.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/30.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printeddress dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
              </div>
              <!-- Electronics Product Activation End Here -->
            </div>
            <!-- #virtual End Here -->
          </div>
          <!-- Tab Content End -->
        </div>
        <!-- main-product-tab-area-->
      </div>
    </div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</div>
<!-- Second Electronics Products Area End Here -->
<!-- Home & Kitchen Products Area Start Here -->
<div class="home-kitchen pb-45">
  <div class="container">
    <div class="row">
      <!-- Electronics Banner Start -->
      <div class="col-xl-3 col-lg-4 col-md-5">
        <!-- Post Title Start -->
        <div class="post-title">
          <h2>
            <i class="ion-tshirt-outline" aria-hidden="true"></i>home &
            kitchen
          </h2>
        </div>
        <!-- Post Title End -->
        <div class="single-banner">
          <a href="shop.html"><img src="templates/img/banner/9.jpg" alt="" /></a>
        </div>
      </div>
      <!-- Electronics Banner End -->
      <div class="col-xl-9 col-lg-8 col-md-7">
        <div class="main-product-tab-area">
          <!-- Nav tabs -->
          <ul class="nav tabs-area" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                data-bs-toggle="tab"
                href="#lg-app"
                >Large Appliances</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#sm-app"
                >Small Appliances</a
              >
            </li>
          </ul>
          <!-- Tab Contetn Start -->
          <div class="tab-content">
            <div id="lg-app" class="tab-pane fade show active">
              <!-- Electronics Product Activation Start Here -->
              <div class="electronics-pro-active owl-carousel">
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/8.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/7.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed Summer Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/12.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">printed dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/13.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                      <span class="sticker-sale">-8%</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">winter Dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/23.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/22.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printed chiffon dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/15.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/14.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed festvie Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/29.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/30.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printeddress dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
              </div>
              <!-- Electronics Product Activation End Here -->
            </div>
            <!-- #g-desktop End Here -->
            <div id="sm-app" class="tab-pane fade">
              <!-- Electronics Product Activation Start Here -->
              <div class="electronics-pro-active owl-carousel">
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/30.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/29.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed Summer Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/10.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/9.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">printed dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/14.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/15.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4><a href="product.html">winter Dress</a></h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/11.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/12.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printed chiffon dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
                <!-- Double Product Start -->
                <div class="double-product">
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/21.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/22.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">Printed festvie Dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p><span class="price">$30</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                  <!-- Single Product Start -->
                  <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="product.html">
                        <img
                          class="primary-img"
                          src="templates/img/products/7.jpg"
                          alt="single-product"
                        />
                        <img
                          class="secondary-img"
                          src="templates/img/products/8.jpg"
                          alt="single-product"
                        />
                      </a>
                      <span class="sticker-new">new</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <h4>
                        <a href="product.html">printeddress dress</a>
                      </h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <p><span class="price">$25.00</span></p>
                      <div class="pro-actions">
                        <div class="actions-primary">
                          <a
                            href="cart.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add to Cart"
                            >Add To Cart</a
                          >
                        </div>
                        <div class="actions-secondary">
                          <span
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Quick View"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#myModal"
                              ><i class="fa fa-heart-o"></i
                            ></a>
                          </span>
                          <a
                            href="product.html"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Details"
                            ><i class="fa fa-signal"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                    <!-- Product Content End -->
                  </div>
                  <!-- Single Product End -->
                </div>
                <!-- Double Product End -->
              </div>
              <!-- Electronics Product Activation End Here -->
            </div>
            <!-- #towers End Here -->
          </div>
          <!-- Tab Content End -->
        </div>
        <!-- main-product-tab-area-->
      </div>
    </div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</div> --}}
<!-- Home & Kitchen Products Area End Here -->

<!-- Support Area Start Here -->
<div class="support-area pb-45">
  <div class="container">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
          <div class="col">
              <div class="single-support d-flex align-items-center">
                  <div class="support-icon">
                      <i class="ion-android-time"></i>
                  </div>
                  <div class="support-desc">
                      <h6>Thứ 2 - Thứ 7 / 8:00 - 18:00</h6>
                      <span>Ngày/Giờ Làm Việc</span>
                  </div>
              </div>
          </div>
          <div class="col">
              <div class="single-support d-flex align-items-center">
                  <div class="support-icon">
                      <i class="ion-ios-telephone"></i>
                  </div>
                  <div class="support-desc">
                      <h6>888 345 6789</h6>
                      <span>Hỗ Trợ Miễn Phí!</span>
                  </div>
              </div>
          </div>
          <div class="col">
              <div class="single-support d-flex align-items-center">
                  <div class="support-icon">
                      <i class="ion-help-buoy"></i>
                  </div>
                  <div class="support-desc">
                      <h6>Support@example.com</h6>
                      <span>Hỗ Trợ Đặt Hàng!</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Container End -->
</div>
<!-- Support Area End Here -->
@section('modal')
  @include('clients.components.modalhome')
@endsection