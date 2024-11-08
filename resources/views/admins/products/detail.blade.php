<div class="container-xxl animated fadeInDown">
    <div class="row">                        
        <div class="col-md-12 col-lg-8">
            <div class="card">  
                <div class="card-body">
                    <div class="row align-items-center">                                        
                        <div class="col ">
                            <div class="d-flex align-items-center">
                                <div class="position-relative div-product-image">
                                    <div>
                                        <img src="{{".".Storage::url($product->image)}}" alt="product" class="img-fluid rounded">
                                    </div>
                                    <div class="position-absolute top-50 start-100 translate-middle">
                                        <img src="{{".".Storage::url($product->category->image)}}" alt="category" class="thumb-sm border border-3 border-white rounded">
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-3"> 
                                    <h5 class="m-0 mb1 fs-3 fw-bold">{{$product->name}}</h5>
                                    <p class="text-muted mb1">{{$product->brand->name}}, {{$product->category->name}}</p>                                                                                                                                 
                                    <span class="badge bg-primary-subtle text-primary">{{date('d/m/Y', strtotime($product->created_at))}}</span>
                                    <div class="d-flex mt-2">
                                        <select name="" class="form-select w-auto fs10 me-1">
                                            <option value="">Tháng</option>
                                            <option value="">01</option>
                                            <option value="">02</option>
                                            <option value="">03</option>
                                        </select>
                                        <select name="" class="form-select w-auto fs10">
                                            <option value="">Năm</option>
                                            <option value="">2024</option>
                                            <option value="">2023</option>
                                            <option value="">2022</option>
                                        </select>
                                    </div>                                                                                                                              
                                </div><!--end media body-->
                            </div><!--end media-->
                        </div><!--end col-->
                        <div class="col-auto text-end">
                            <button type="button" class="rounded-pill btn btn-sm btn-{{$product->status === 'active' ? 'primary' : 'danger'}} px-2 d-inline-flex align-items-center text-capitalize"><i class="fas fa-{{$product->status === 'active' ? 'check' : 'xmark'}} fs-14 me-1"></i>{{$product->status}}</button>
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="mt-3">
                        <div class="text-body mb-1 d-flex align-items-center"><span class="text-body fw-semibold">Mã sản phẩm :</span>&nbsp;<span class="text-primary fw-semibold">{{$product->product_code}}</span></div>
                        <div class="price-section">
                            
                                <span class="text-danger">{{ number_format($product->product_variants_min_price, 0, '', '.') }} VNĐ - {{ number_format($product->product_variants_max_price, 0, '', '.') }} VNĐ</span>
                         
                        </div>
                        
                        <div class="text-body mb-3 d-flex align-items-center"><span class="text-body fw-semibold">Số lượng :</span>&nbsp;<span>{{$product->product_variants_sum_quantity}}</span></div>                                                            
                        <div class="text-body mb-1"><span class="text-body fw-semibold">Mô tả ngắn :</span>&nbsp;<span>{!!$product->short_description ? $product->short_description : "<p>Sản phẩm chưa có mô tả ngắn</p>"!!}</span></div>                                                            
                        <div class="text-body mb-0"><span class="text-body fw-semibold">Mô tả chi tiết :</span>&nbsp;<span>{!!$product->description ? $product->description : "<p>Sản phẩm chưa có mô tả chi tiết</p>"!!}</span></div>                                                            
                    </div>
                </div><!--end card-body-->  
            </div><!--end card-->                             
        </div> <!--end col--> 
        <div class="col-md-12 col-lg-4">
            <div class="card">                                
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-6"> 
                            <div class="card shadow-none border mb-3 mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center">
                                        <i class="iconoir-dollar-circle fs-24 align-self-center text-danger me-2"></i>
                                        <div class="flex-grow-1 text-truncate">
                                            <p class="text-danger mb-0 fw-semibold fs-13">Doanh thu</p>    
                                            <h3 class="mt-1 mb-0 fs11 fw-bold text-danger"> {{ number_format($totalRevenue) }} VNĐ</h3>                                                                                                                                   
                                        </div><!--end media body-->
                                    </div>
                                </div><!--end card-body-->
                            </div> <!--end card-body-->                     
                        </div><!--end col-->
                        <div class="col-md-6 col-lg-6"> 
                            <div class="card shadow-none border mb-3 mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center">
                                        <i class="iconoir-cart fs-24 align-self-center text-blue me-2"></i>
                                        <div class="flex-grow-1 text-truncate"> 
                                            <p class="text-blue mb-0 fw-semibold fs-13">Đã bán</p>    
                                            <h3 class="mt-1 mb-0 fs11 fw-bold text-blue">{{ $totalSales }}</h3>                                                                                                                                   
                                        </div><!--end media body-->
                                    </div>
                                </div><!--end card-body-->
                            </div> <!--end card-body-->                     
                        </div><!--end col-->
                        
                        <div class="col-md-6 col-lg-6"> 
                            <div class="card shadow-none border mb-3 mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center">
                                        <i class="iconoir-thumbs-up fs-24 align-self-center text-primary me-2"></i>
                                        <div class="flex-grow-1 text-truncate"> 
                                            <p class="text-primary mb-0 fw-semibold fs-13">Đánh giá</p>    
                                            <h3 class="mt-1 mb-0 fs11 fw-bold text-primary">{{ $product->reviews_count }}</h3>                                                                                                                                   
                                        </div><!--end media body-->
                                    </div>
                                </div><!--end card-body-->
                            </div> <!--end card-->                     
                        </div><!--end col-->  
                        <div class="col-md-6 col-lg-6"> 
                            <div class="card shadow-none border mb-3 mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center">
                                        <i class="iconoir-eye fs-24 align-self-center text-info me-2"></i>
                                        <div class="flex-grow-1 text-truncate"> 
                                            <p class="text-info mb-0 fw-semibold fs-13">Lượt xem</p>    
                                            <h3 class="mt-1 mb-0 fs11 fw-bold text-info">{{ $viewsCount }}</h3>                                                                                                                                   
                                        </div><!--end media body-->
                                    </div>
                                </div><!--end card-body-->
                            </div> <!--end card-body-->                     
                        </div><!--end col-->                              
                    </div><!--end row-->
                </div><!--end card-body--> 
            </div><!--end card-->
            <div class="card">                                
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="{{$product->user->image ? $product->user->image : ($product->user->role == 1 ? 'assets/images/users/avatar-default-admin.png' : 'assets/images/users/avatar-default-staff.png')}}" alt="" class="user-image rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3 text-truncate">
                            <h4 class="mb-1 fw-semibold">{{$product->user->name}}</h4>
                            <p class="mb-3 font-13 text-{{$product->user->role == 1 ? "danger" : "blue"}}">{{$product->user->role == 1 ? "Admin" : "Nhân viên"}}</p>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-sm btn-outline-primary fs10">Xem</button>
                                <div class="d-flex flex-column justify-content-end"><span class="badge bg-primary-subtle text-primary">Người thêm</span></div>
                            </div>
                        </div><!--end media-body-->
                    </div><!--end media-->
                </div><!--end card-body--> 
            </div><!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Ảnh khác</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="row g-2">
                        @forelse ($product->galleries as $gallery)
                        <div class="col-3 col-md-2 col-lg-3">
                            <a class="d-inline-block" href="#">
                                @if ($gallery->type === "image")
                                <img src="{{".".Storage::url($gallery->path)}}" alt="gallery" class="w-100 rounded">
                                @else
                                Long
                                @endif
                            </a>
                        </div>
                        @empty
                            <p class="text-danger">Không có ảnh nào</p>
                        @endforelse
                    </div>
                </div><!--end card-body--> 
            </div><!--end card-->
        </div> <!--end col-->        
           
    </div><!--end row-->  
     
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thông tin biến thể</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                              <tr>
                                <th>Biến thể</th>
                                <th>Giá nhập</th>
                                <th>Giá niêm yết</th>
                                <th>Giá bán</th>
                                <th>Số lượng</th>
                                <th>Đã bán</th>
                                <th>Trạng thái</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->productVariants as $productVariant)
                                <tr>
                                    <td>
                                        <img class="me-1" src="{{".".Storage::url($productVariant->image)}}" alt="" height="40">
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="{{route('product.show', $product->id)}}" class="d-inline-block align-middle mb-0 product-name">{{$product->name}}</a> 
                                            <br>
                                            <span class="text-muted fs11">{{$productVariant->color->name}}-{{$productVariant->ssd->name}}</span> 
                                        </p>
                                    </td>
                                    <td class="text-success">{{number_format($productVariant->import_price, 0, '', '.')}} vnđ</td>
                                    <td class="text-blue">{{number_format($productVariant->listed_price, 0, '', '.')}} vnđ</td>
                                    <td class="text-danger">{{number_format($productVariant->price, 0, '', '.')}} vnđ</td>
                                    <td class="text-dark">{{$productVariant->quantity}}</td>
                                    <td class="text-primary">
                                        <span>30</span>
                                    </td>
                                    <td><span class="badge bg-{{$productVariant->quantity===0 ? 'danger' : 'success'}}-subtle text-{{$productVariant->quantity===0 ? 'danger' : 'success'}} text-capitalize"><i class="fas fa-{{$productVariant->quantity===0 ? 'xmark' : 'check'}} me-1"></i> {{$productVariant->quantity===0 ? 'Hết hàng' : 'Còn hàng'}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->           
    
    {{-- Đánh giá --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Đánh giá sản phẩm</h4>                      
                        </div><!--end col-->
                    </div><!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                              <tr>
                                <th>Người đánh giá</th>
                                <th>Đánh giá</th>
                                <th>Ngày đánh giá</th>
                                <th>Nội dung</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($product->reviews as $review)
                                    <tr>
                                        <td>{{ $review->user->name }}</td>
                                        <td>
                                            {{-- Hiển thị số sao bằng biểu tượng --}}
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->star)
                                                    <i class="fas fa-star text-warning"></i> {{-- Sao đầy --}}
                                                @else
                                                    <i class="far fa-star text-warning"></i> {{-- Sao rỗng --}}
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{ $review->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $review->content }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Chưa có đánh giá nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                    </div>
                </div><!--end card-body--> 
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
    

</div><!-- container -->