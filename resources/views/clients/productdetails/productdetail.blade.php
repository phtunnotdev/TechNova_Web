@include('clients.components.breadcrumb')
 <!-- Product Thumbnail Start -->
<!-- Product Thumbnail Start -->
<div class="main-product-thumbnail ptb-45">
    <div class="container">
        <div class="thumb-bg">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb{{$product->id}}" class="tab-pane fade show active d-flex align-items-center aspect-ratio d-flex justify-content-center">
                            <a data-fancybox="images" id="link-image-main" href="{{".".Storage::url($product->image)}}"><img
                                    id="image-main" class="w-100" src="{{".".Storage::url($product->image)}}" alt="product-view"></a>
                        </div>
                        @foreach ($product->galleries as $gallery)
                        <div id="thumbgl{{$gallery->id}}" class="tab-pane fade d-flex align-items-center aspect-ratio d-flex justify-content-center">
                           <a data-fancybox="images" href="{{".".Storage::url($gallery->path)}}"><img
                                   src="{{".".Storage::url($gallery->path)}}" class="w-100" alt="product-view"></a>
                       </div>
                        @endforeach
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail">
                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                            <a class="active d-flex align-items-center aspect-ratio" data-bs-toggle="tab" href="#thumb{{$product->id}}"><img
                                    src="{{".".Storage::url($product->image)}}" alt="product-thumbnail"></a>
                           @foreach ($product->galleries as $gallery)
                            <a data-bs-toggle="tab" class="d-flex align-items-center aspect-ratio" href="#thumbgl{{$gallery->id}}"><img src="{{".".Storage::url($gallery->path)}}"
                                    alt="product-thumbnail"></a>
                           @endforeach
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
               <!-- Main Thumbnail Image End -->
               <!-- Thumbnail Description Start -->
               <div class="col-lg-7">
                   <form action="{{ route('client.addToCart') }}" method="post">
                       @csrf
                       <div class="thubnail-desc fix">
                           <h3 class="product-header mb-1 mt-3">{{ $product->name }}</h3>
                           <div class="rating-summary fix mtb-10">
                                <div class="rating">
                                    @php
                                        $fullStars = floor($averageRating); // Số sao đầy
                                        $halfStar = $averageRating - $fullStars; // Phần thập phân
                                    @endphp
                                    
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="fa-solid fa-star" style="color: gold;"></i> <!-- Sao đầy -->
                                        @elseif ($i == $fullStars + 1 && $halfStar >= 0.5)
                                            <i class="fa-solid fa-star-half-alt" style="color: gold;"></i> <!-- Nửa sao -->
                                        @else
                                            <i class="fa-regular fa-star" style="color: gray;"></i> <!-- Sao rỗng -->
                                        @endif
                                    @endfor
                                </div>
                                
                                <div class="rating-feedback">
                                    <a href="#" class="mt-1">({{ $product->reviews_count }} đánh giá)</a>
                                </div>
                            </div>
                        
                           <div class="pro-price mtb-10">
                               <p class="d-flex align-items-center"><span class="price" id="price">{{ number_format($product->product_variants_min_price, 0, '', '.') }} vnđ - {{ number_format($product->product_variants_max_price, 0, '', '.') }} vnđ</span><span id="sale"></span></p>
                           </div>
                           <p class="mb-20 pro-desc-details">{!! $product->short_description !!}</p>
                           
                           <div class="color clearfix mb-20">
                               <label class="mb-2 mt-4">Màu Sắc</label>
                               <div class="product-options">
                                   @foreach ($product->productVariants->unique('color_id') as $productVariant)
                                   <div class="form-check ps-0">
                                       <input class="form-check-input form-check-input2" type="radio" name="color" id="color{{ $productVariant->color->id }}" value="{{ $productVariant->color->id }}" required>
                                       <label class="form-check-label ms-0 me-2 text-nowrap" for="color{{ $productVariant->color->id }}">{{ $productVariant->color->name }}</label>
                                   </div>
                                   @endforeach
                               </div>
                               @if ($errors->has('color'))
                                   <p class="text-danger mb-0">{{$errors->first('color')}}</p>
                               @endif
                           </div>

                           <div class="product-size mb-20 clearfix">
                                <label class="mb-2">Dung lượng</label>
                                <div class="product-options">
                                    @foreach ($product->productVariants->unique('ssd_id') as $productVariant)
                                    <div class="form-check ps-0">
                                        <input class="form-check-input form-check-input1" type="radio" name="ssd" id="ssd{{ $productVariant->ssd->id }}" value="{{ $productVariant->ssd->id }}" required>
                                        <label class="form-check-label ms-0 me-2 text-nowrap" for="ssd{{ $productVariant->ssd->id }}">{{ $productVariant->ssd->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @if ($errors->has('ssd'))
                                   <p class="text-danger mb-0">{{$errors->first('ssd')}}</p>
                               @endif
                            </div>

                           <div class="box-quantity d-flex my-4">
                               <label class="me-3">Số Lượng</label>
                               <input class="quantity mr-40" name="quantity" type="number" min="1" value="1">
                               <button class="btn add-cart" type="submit">Thêm vào giỏ hàng</button>
                           </div>
                           @if ($errors->has('quantity'))
                                   <p class="text-danger mb-0">{{$errors->first('quantity')}}</p>
                               @endif
                           
                           <input type="hidden" name="product" value="{{$product->id}}">   

                           <div class="pro-ref mt-15">
                               <label><b>Số lượng có sẵn:</b> <span id="result-quantity">{{ $product->product_variants_sum_quantity }}</span></label>
                           </div>
                       </div>
                   </form>
                   
               </div>
               <!-- Thumbnail Description End -->
           </div>
           <!-- Row End -->
       </div>
   </div>
   <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-45">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="main-thumb-desc nav tabs-area" role="tablist">
                    <li><a class="active" data-bs-toggle="tab" href="#dtail">Mô tả sản phẩm</a></li>
                    <li><a  data-bs-toggle="tab" href="#review">Đánh giá</a></li>
                </ul>   
                <!-- Product Thumbnail Tab Content Start -->
                <div class="tab-content thumb-content border-default">
                    <div id="dtail" class="tab-pane fade show active">
                        <p>{!!$product->description!!}</p>
                    </div>
                    <div id="review" class="tab-pane fade">
                        <!-- Đánh giá sản phẩm -->
                        <div class="product-reviews">
                            <div class="group-title">
                                <h2>Đánh giá sản phẩm</h2>
                            </div>
                
                            <div class="reviews-list">
                                @if ($product->reviews->isEmpty())
                                    <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                                @else
                                    @foreach ($product->reviews as $review)
                                        <div class="review-item">
                                            <div class="row">
                                                <div class="col-1">
                                                    <img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-user-cartoon-avatar-pattern-flat-avatar-png-image_4492883.jpg" alt="User Avatar" class="user-avatar">
                                                </div>
                                                <div class="col-11">
                                                    <div class="review-content">
                                                        <h5 class="review-username mb-1">{{ $review->user->name }}</h5>
                                                        <div class="star-rating">
                                                            <div class="star-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="fa{{ $i <= $review->star ? '-solid' : '-regular' }} fa-star" style="color: {{ $i <= $review->star ? 'gold' : 'gray' }};"></i>
                                                                @endfor
                                                            </div>
                                                            
                                                            <p class="review-date">{{ $review->created_at->format('d/m/Y') }}</p>
                                                        </div>
                                                        <p class="review-text">{{ $review->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            
                        </div>

                       
                    </div>
                </div>
                <!-- Product Thumbnail Tab Content End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>

<!-- Product Thumbnail Description End -->
<!-- Realted Products Start Here -->
<div class="second-featured-products related-pro pb-45">
    <div class="container">
        <!-- Post Title Start -->
        <div class="post-title">
            <h2><i class="fa fa-trophy" aria-hidden="true"></i>Sản phẩm liên quan</h2>
        </div>
        <!-- Post Title End -->
        <!-- New Pro Tow Activation Start -->
        <div class="featured-pro-active owl-carousel">
            <!-- Single Product Start -->
            @forelse ($product->category->products->where('id', '<>', $product->id) as $relatedProduct )
            <div class="single-product">
                <!-- Product Image Start -->
                <div class="pro-img w-100 d-flex align-items-center" style="aspect-ratio: 1/1">
                  <a href="{{route('client.product.detail', $relatedProduct->id)}}">
                    <img
                      class="primary-img"
                      src="{{".".Storage::url($relatedProduct->image)}}"
                      alt="single-product"
                    />
                    {{-- <img
                      class="secondary-img"
                      src="{{".".Storage::url($relatedProduct->galleries->first()->path)}}"
                      alt="single-product"
                    /> --}}
                  </a>
                  {{-- <div class="countdown bg-main text-white" data-countdown="2024/12/01"></div> --}}
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                  <div class="pro-info">
                    <h4><a href="product.html">{{$relatedProduct->name}}</a></h4>
                    <div class="product-rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <p>
                      <span class="price" style="font-size: 14px">{{number_format($relatedProduct->productVariants->min('price'), 0, '', '.')}}đ - {{number_format($relatedProduct->productVariants->max('price'), 0, '', '.')}}đ</span
                      >
                    </p>
                  </div>
                  <div class="pro-actions">
                    <div class="actions-primary">
                      <a
                        href="cart.html"
                        class="px-1"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Xem chi tiết"
                        >Xem chi tiết</a
                      >
                    </div>
                    <div class="actions-secondary">
                      <a
                        href="product.html"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Yêu thích"
                        ><i class="fa fa-heart-o"></i
                      ></a>
                    </div>
                  </div>
                </div>
                <!-- Product Content End -->
                {{-- <span class="sticker-new">mới</span> --}}
                {{-- <span class="sticker-sale">-5%</span> --}}
              </div>
            @empty
            <p class="text-danger">Không có sản phẩm nào</p>
            @endforelse
            <!-- Single Product End -->
        </div>
        <!-- New Pro Tow Activation End -->
    </div>
    <!-- Container End -->
</div>


<!-- Realated Products End Here -->
@section('script')
<script>
    // Lấy tất cả radio buttons
    const radioButtons = document.querySelectorAll('.form-check-input1');

    // Lặp qua từng radio button và lắng nghe sự kiện click
    radioButtons.forEach(radio => {
        radio.addEventListener('click', function () {
            // Bỏ chọn tất cả radio button khác
            radioButtons.forEach(rb => {
                if (rb !== this) {
                    rb.checked = false; // Bỏ chọn
                    rb.nextElementSibling.style.backgroundColor = ""; // Đặt lại màu nền
                    rb.nextElementSibling.style.color = ""; // Đặt lại màu chữ
                    rb.nextElementSibling.style.borderColor = ""; // Đặt lại màu viền
                }
            });

            // Cập nhật màu sắc cho nhãn tương ứng với radio button đã chọn
            this.nextElementSibling.style.backgroundColor = "#22c55e"; // Màu nền khi chọn
            this.nextElementSibling.style.color = "white"; // Màu chữ khi chọn
            this.nextElementSibling.style.borderColor = "#22c55e"; // Màu viền khi chọn
        });
    });
    //-------------- phần màu sắc
    const radioButtonsColor = document.querySelectorAll('.form-check-input2');

// Lặp qua từng radio button và lắng nghe sự kiện click
radioButtonsColor.forEach(radio => {
radio.addEventListener('click', function () {
    // Bỏ chọn tất cả radio button khác
    radioButtonsColor.forEach(rb => {
        if (rb !== this) {
            rb.checked = false; // Bỏ chọn
            rb.nextElementSibling.style.backgroundColor = ""; // Đặt lại màu nền
            rb.nextElementSibling.style.color = ""; // Đặt lại màu chữ
            rb.nextElementSibling.style.borderColor = ""; // Đặt lại màu viền
        }
    });

    // Cập nhật màu sắc cho nhãn tương ứng với radio button đã chọn
    this.nextElementSibling.style.backgroundColor = "#22c55e"; // Màu nền khi chọn
    this.nextElementSibling.style.color = "white"; // Màu chữ khi chọn
    this.nextElementSibling.style.borderColor = "#22c55e"; // Màu viền khi chọn
});
});

    // Hàm kiểm tra nếu cả hai checkbox đều được chọn
    function checkBothSelected() {
        // Lắng nghe sự kiện change trên tất cả checkbox
        const ssdCheckboxes = document.querySelectorAll('.form-check-input1');
        const colorCheckboxes = document.querySelectorAll('.form-check-input2');
        const ssdsChecked = document.querySelectorAll('.form-check-input1:checked').length > 0; // Kiểm tra nếu có ít nhất một color được chọn
        const colorsChecked = document.querySelectorAll('.form-check-input2:checked').length > 0; // Kiểm tra nếu có ít nhất một ssd được chọn
        const ssdValue = document.querySelector('.form-check-input1:checked');
        const colorValue = document.querySelector('.form-check-input2:checked');
        const productVariants = <?php echo json_encode($product->productVariants); ?>;
        const resultQuantity = document.getElementById('result-quantity');
        const linkImageMain = document.getElementById('link-image-main');
        const imageMain = document.getElementById('image-main');
        const price = document.getElementById('price');
        const sale = document.getElementById('sale');
        // Reset trạng thái disabled cho tất cả SSD
        ssdCheckboxes.forEach(input => {
            input.disabled = false;
        });

        // Reset trạng thái disabled cho tất cả màu
        colorCheckboxes.forEach(input => {
            input.disabled = false;
        });

        if (colorsChecked) {
            // Lọc ra các SSD hợp lệ dựa trên color được chọn
            let validSSDs = productVariants.filter(variant => variant.color_id == colorValue.value && variant.quantity > 0 )
                                            .map(variant => variant.ssd_id);
                                            

            // Disable SSDs không có trong danh sách hợp lệ
            ssdCheckboxes.forEach(input => {
                if (!validSSDs.includes(parseInt(input.value))) {
                    input.disabled = true; // Disable SSD không hợp lệ
                }
            });
        }

        if (ssdsChecked) {
            // Lọc ra các màu hợp lệ dựa trên SSD được chọn
            let validColors = productVariants.filter(variant => variant.ssd_id == ssdValue.value && variant.quantity > 0 )
                                            .map(variant => variant.color_id);

            // Disable màu không có trong danh sách hợp lệ
            colorCheckboxes.forEach(input => {
                if (!validColors.includes(parseInt(input.value))) {
                    input.disabled = true; // Disable màu không hợp lệ
                }
            });
        }
        if (colorsChecked && ssdsChecked) {
            productVariants.forEach(variant => {
            if(ssdValue.value == variant.ssd_id && colorValue.value == variant.color_id){
                resultQuantity.textContent = variant.quantity;
                linkImageMain.href = "./storage/" + variant.image;
                imageMain.src = "./storage/" + variant.image;
                price.innerHTML = '<del class="prev-price me-3">' + variant.listed_price.toLocaleString('de-DE') + ' vnđ</del>' + variant.price.toLocaleString('de-DE') + ' vnđ';
                var number = ((variant.listed_price - variant.price) / variant.listed_price) * 100;
                var saleResult = (number % 1 >= 0.5) ? Math.ceil(number) : Math.floor(number);
                sale.innerHTML = '<span class="saving-price">- ' + saleResult + '%</span>';
            } 
            });
        }
    }
    const ssdCheckboxes = document.querySelectorAll('.form-check-input1');
    const colorCheckboxes = document.querySelectorAll('.form-check-input2');
    ssdCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', checkBothSelected);
    });

    colorCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', checkBothSelected);
    });
    </script>
@endsection