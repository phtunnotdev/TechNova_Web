<div class="container-xxl animated fadeInDown">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                            <div class="d-flex align-items-center flex-row flex-wrap">
                                <div class="position-relative me-3">
                                    <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" height="120" class="rounded-circle">
                                    <a href="#" class="thumb-md justify-content-center d-flex align-items-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg">
                                        <i class="fas fa-camera"></i>
                                    </a>
                                </div>
                                <div class="">
                                    <h5 class="fw-semibold fs-20 mb-1">{{$user->name}}</h5>
                                    <p class="mb-0 text-muted mb2">ID: <span class="text-primary fw-medium">{{$user->user_code}}</span></p>
                                    <span class="badge bg-primary-subtle text-primary text-capitalize me-1">Khách Hàng</span>
                                    <span class="badge bg-{{$user->status == "active" ? "success" : "danger"}} text-capitalize">{{$user->status}}</span>
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
                                </div>
                            </div>                                                
                        </div><!--end col-->
                        
                        <div class="col-lg-5 ms-auto align-self-center">
                            <div class="d-flex justify-content-center">
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                    <h5 class="fw-semibold fs-18 mb-1">07</h5>
                                    <p class="text-muted mb-0 fw-medium">Xếp hạng</p>
                                </div>
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                    <h5 class="fw-semibold fs-18 mb-1">05</h5>
                                    <p class="text-muted mb-0 fw-medium">Đơn hàng</p>
                                </div>
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                    <h5 class="fw-semibold fs-18 mb-1 text-danger">1 triệu</h5>
                                    <p class="text-muted mb-0 fw-medium">Đã chi</p>
                                </div>
                            </div>                                          
                        </div><!--end col-->
                        <div class="col-lg-3 align-self-center">
                            <div class="row row-cols-2">
                                <div class="col text-end">
                                    <div id="complete" class="apex-charts"></div>
                                </div>  
                                <div class="col align-self-center text-center">
                                    <span class="fw-medium">Ngày tham gia</span>
                                    <span>{{date('d/m/Y', strtotime($user->created_at))}}</span>
                                </div>
                            </div>                                   
                        </div><!--end col-->
                    </div><!--end row-->               
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col-->                                  
    </div><!--end row-->

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thông Tin Khách Hàng</h4>                      
                        </div><!--end col-->
                        <div class="col-auto">                      
                            <a href="{{route('user.edit', $user->id)}}" class="float-end text-muted d-inline-flex text-decoration-underline"><i class="iconoir-edit-pencil fs-18 me-1"></i>Sửa</a>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <ul class="list-unstyled mb-0">               
                        <li><i class="fas fa-code me-1 text-secondary fs-5 align-middle"></i> <b> ID </b> : {{$user->user_code}}</li>
                        <li class="mt-2"><i class="fas fa-signature me-1 text-secondary fs-5 align-middle"></i> <b> Họ Tên </b> : {{$user->name}}</li>
                        <li class="mt-2"><i class="fas fa-user-tie me-1 text-secondary fs-5 align-middle"></i> <b>&nbsp;&nbsp;Vai trò </b> : Khách Hàng</li>
                        <li class="mt-2"><i class="fas fa-temperature-half me-1 text-secondary fs-5 align-middle"></i> <b>&nbsp;&nbsp;&nbsp;Trạng thái </b> : {{$user->status}}</li>
                        <li class="mt-2"><i class="fas fa-phone me-1 text-secondary fs-5 align-middle"></i> <b>&nbsp;Điện thoại </b> : {{$user->phone ? $user->phone : "Chưa cập nhật"}}</li>
                        <li class="mt-2"><i class="fas fa-envelope text-secondary fs-5 align-middle me-1"></i> <b>&nbsp;Email </b> : {{$user->email}}</li>
                        <li class="mt-2 d-flex"><i class="fas fa-location-dot me-1 text-secondary fs-5 align-middle"></i> <p class="mb-0 d-flex"><b>&nbsp;&nbsp;&nbsp;Địa chỉ</b>&nbsp;:&nbsp;<span style="flex: 1">{{$user->address ? $user->address : "Chưa cập nhật"}}</span></p></li>
                    </ul>    
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col--> 
        <div class="col-md-8">
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link fw-medium active" data-bs-toggle="tab" href="#order" role="tab" aria-selected="true">Đơn hàng (5)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" data-bs-toggle="tab" href="#product" role="tab" aria-selected="false">Sản phẩm (8)</a>
                </li>                                                
                <li class="nav-item">
                    <a class="nav-link fw-medium" data-bs-toggle="tab" href="#comment" role="tab" aria-selected="false">Bình luận (7)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" data-bs-toggle="tab" href="#review" role="tab" aria-selected="false">Đánh giá (4)</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="order" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th class="bg-primary text-white">ID</th>
                                                <th class="bg-primary text-white">Sản phẩm</th>
                                                <th class="bg-primary text-white">Ngày đặt</th>
                                                <th class="bg-primary text-white">Thanh toán</th>
                                                <th class="bg-primary text-white">Trạng thái</th>
                                                <th class="bg-primary text-white">Tổng tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="ecommerce-order-details.html"><span class="badge bg-transparent border border-primary text-primary">OR-KmdK3</span></a></td>
                                                    <td class="d-flex">
                                                        <div class="mr2 position-relative">
                                                            <img src="assets/images/products/04.png" alt="product" class="rounded-circle" height="30">
                                                            <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">2</div>
                                                        </div>
                                                        <div>
                                                            <img src="assets/images/products/05.png" alt="product" class="rounded-circle" height="30">
                                                        </div>
                                                    </td>
                                                    <td>15/08/2023</td>
                                                    <td>UPI</td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success"><i class="fas fa-check me-1"></i> Hoàn thành</span>
                                                    </td>
                                                    <td class="text-danger">12.000.000 vnđ</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="ecommerce-order-details.html"><span class="badge bg-transparent border border-primary text-primary">OR-3Nh7q</span></a></td>
                                                    <td class="d-flex">
                                                        <div class="mr2 position-relative">
                                                        <img src="assets/images/products/01.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">3</div>
                                                        </div>
                                                        <div class="mr2 position-relative">
                                                        <img src="assets/images/products/02.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">5</div>
                                                        </div>
                                                        <div class="position-relative">
                                                        <img src="assets/images/products/03.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">2</div>
                                                        </div>
                                                    </td>
                                                    <td>22/09/2023</td>
                                                    <td>Banking</td>
                                                    <td>
                                                        <span class="badge bg-purple-subtle text-purple"><i class="fas fa-hourglass-start me-1"></i> Chờ giao hàng</span>
                                                    </td>
                                                    <td class="text-danger">12.000.000 vnđ</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="ecommerce-order-details.html"><span class="badge bg-transparent border border-primary text-primary">OR-nH63G</span></a></td>
                                                    <td class="d-flex">
                                                        <div class="mr2 position-relative">
                                                        <img src="assets/images/products/03.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">3</div>
                                                        </div>
                                                        <div class="mr2 position-relative">
                                                        <img src="assets/images/products/01.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">4</div>
                                                        </div>
                                                        <div>
                                                        <img src="assets/images/products/06.png" alt="product" class="rounded-circle" height="30">
                                                        </div>
                                                    </td>
                                                    <td>31/12/2023</td>
                                                    <td>Paypal</td>
                                                    <td>
                                                        <span class="badge bg-danger-subtle text-danger"><i class="fas fa-xmark me-1"></i> Đã hủy</span>
                                                    </td>
                                                    <td class="text-danger">12.000.000 vnđ</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="ecommerce-order-details.html"><span class="badge bg-transparent border border-primary text-primary">OR-lM63U</span></a></td>
                                                    <td class="d-flex">
                                                        <div class="mr2">
                                                        <img src="assets/images/products/05.png" alt="product" class="rounded-circle" height="30">
                                                        </div>
                                                        <div class="position-relative">
                                                        <img src="assets/images/products/06.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">2</div>
                                                        </div>
                                                    </td>
                                                    <td>05/01/2024</td>
                                                    <td>UPI</td>
                                                    <td>
                                                        <span class="badge bg-info-subtle text-info"><i class="fas fa-truck me-1"></i> Đang giao hàng</span>
                                                    </td>
                                                    <td class="text-danger">12.000.000 vnđ</td>
                                                </tr>                                                                                 
                                                <tr>
                                                    <td><a href="ecommerce-order-details.html"><span class="badge bg-transparent border border-primary text-primary">OR-Nhfy9</span></a></td>
                                                    <td class="d-flex">
                                                        <div class="mr2">
                                                        <img src="assets/images/products/04.png" alt="product" class="rounded-circle" height="30">
                                                        </div>
                                                        <div class="mr2">
                                                        <img src="assets/images/products/01.png" alt="product" class="rounded-circle" height="30">
                                                        </div>
                                                        <div class="position-relative">
                                                        <img src="assets/images/products/02.png" alt="product" class="rounded-circle" height="30">
                                                        <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">2</div>
                                                        </div>
                                                    </td>
                                                    <td>20/02/2024</td>
                                                    <td>BTC</td>
                                                    <td>
                                                        <span class="badge bg-warning-subtle text-warning"><i class="fas fa-clock me-1"></i> Chờ xác nhận</span>
                                                    </td>
                                                    <td class="text-danger">12.000.000 vnđ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product" role="tabpanel">
                    <div id="grid" class="row pb-3 g-2">
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-1.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-7.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-2.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-1.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-3.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-2.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-4.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-3.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-5.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-4.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-6.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-5.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-1.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-6.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-0">
                                <a href="#">
                                  <img class="card-img-top img-fluid bg-light-alt" src="assets/images/extra/card/img-2.jpg" alt="Card image cap">
                                </a>
                                <div class="card-header p-2">
                                    <div class="row align-items-center">
                                        <div class="col-12">                      
                                            <h4 class="card-title fs-6 mb2"><a href="#" class="text-inherit text-underline">iPhone 15 plus</a></h4>
                                            <p class="text-danger mb-0 fs10">12.000.000 vnđ</p>               
                                        </div><!--end col-->                                                                              
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body p-2 pt-0 d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm fw-normal py2">Xem</a>
                                    <div>    
                                        <a href="#">
                                          <img class="rounded-circle" src="assets/images/users/avatar-7.jpg" alt="" height="24">  
                                        </a>
                                    </div>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                    </div> 
                </div>                                                
                <div class="tab-pane" id="comment" role="tabpanel">
                    <div class="card">
                        <div class="card-body border-bottom-dashed pb-4"> 
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <div class="row">
                                        <div class="col-auto">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" class="thumb-md rounded-circle">
                                        </div><!--end col-->
                                        <div class="col">
                                            <div class="bg-light rounded ms-n2 bg-light-alt p-3 py-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-dark fw-semibold mb-2">{{$user->name}} <span class="fw-normal">đã bình luận cho sản phẩm</span> <a href="#" class="text-inherit text-underline">iPhone 15 plus</a></p>
                                                    </div><!--end col-->
                                                    <div class="col-auto">
                                                        <span class="text-muted"><i class="far fa-clock me-1"></i>30 phút trước</span>
                                                    </div><!--end col-->
                                                </div><!--end row-->                                                                
                                                <p>
                                                    Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm bởi nội dung có thể đọc được của một trang khi nhìn vào bố cục của nó. 
                                                    Mục đích của việc sử dụng Lorem Ipsum là nó có sự phân bố chữ cái ít nhiều bình thường.
                                                </p>
                                                <span class="text-muted">20:05 11/12/2004</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    {{-- <ul class="list-unstyled ms-5">
                                        <li>
                                            <div class="row mt-3">
                                                <div class="col-auto">
                                                    <img src="assets/images/logo-sm.png" alt="" class="thumb-md rounded-circle">
                                                </div><!--end col-->
                                                <div class="col">
                                                    <div class="bg-light rounded ms-n2 bg-light-alt p-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="text-dark fw-semibold mb-2">Metrica Author</p>
                                                            </div><!--end col-->
                                                            <div class="col-auto">
                                                                <span class="text-muted"><i class="far fa-clock me-1"></i>37 min ago</span>
                                                            </div><!--end col-->
                                                        </div><!--end row-->                                                                
                                                        <p>It is a long established fact that a reader will be distracted by the 
                                                            readable content of a page when looking at its layout. 
                                                        </p>
                                                        <p class="mb-0">Thank you</p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </li>
                                    </ul> --}}
                                </li>
                                <li class="mt-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" class="thumb-md rounded-circle">
                                        </div><!--end col-->
                                        <div class="col">
                                            <div class="bg-light rounded ms-n2 bg-light-alt p-3 py-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-dark fw-semibold mb-2">{{$user->name}} <span class="fw-normal">đã bình luận cho bài viết</span> <a href="#" class="text-inherit text-underline">iPhone 15 plus</a></p>
                                                    </div><!--end col-->
                                                    <div class="col-auto">
                                                        <span class="text-muted"><i class="far fa-clock me-1"></i>30 phút trước</span>
                                                    </div><!--end col-->
                                                </div><!--end row-->                                                                
                                                <p>
                                                    Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm bởi nội dung có thể đọc được của một trang khi nhìn vào bố cục của nó.
                                                </p>
                                                <span class="text-muted">20:05 11/12/2004</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </li>
                                <li class="mt-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" class="thumb-md rounded-circle">
                                        </div><!--end col-->
                                        <div class="col">
                                            <div class="bg-light rounded ms-n2 bg-light-alt p-3 py-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-dark fw-semibold mb-2">{{$user->name}} <span class="fw-normal">đã bình luận cho sản phẩm</span> <a href="#" class="text-inherit text-underline">iPhone 15 plus</a></p>
                                                    </div><!--end col-->
                                                    <div class="col-auto">
                                                        <span class="text-muted"><i class="far fa-clock me-1"></i>30 phút trước</span>
                                                    </div><!--end col-->
                                                </div><!--end row-->                                                                
                                                <p>
                                                    Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm bởi nội dung có thể đọc được.
                                                </p>
                                                <span class="text-muted">20:05 11/12/2004</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    {{-- <ul class="list-unstyled ms-5">
                                        <li>
                                            <div class="row mt-3">
                                                <div class="col-auto">
                                                    <img src="assets/images/logo-sm.png" alt="" class="thumb-md rounded-circle">
                                                </div><!--end col-->
                                                <div class="col">
                                                    <div class="bg-light rounded ms-n2 bg-light-alt p-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="text-dark fw-semibold mb-2">Metrica Author</p>
                                                            </div><!--end col-->
                                                            <div class="col-auto">
                                                                <span class="text-muted"><i class="far fa-clock me-1"></i>37 min ago</span>
                                                            </div><!--end col-->
                                                        </div><!--end row-->                                                                
                                                        <p>It is a long established fact that a reader will be distracted by the 
                                                            readable content of a page when looking at its layout. 
                                                        </p>
                                                        <p class="mb-0">Thank you</p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </li>
                                    </ul>  --}}
                                </li>
                            </ul> 
                        </div><!--end card-body--> 
                        {{-- <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark fw-semibold mb-0">Leave a comment</p>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->  --}}
                        {{-- <div class="card-body pt-0">
                            <form>
                                <div class="form-group mb-3">
                                    <textarea class="form-control" rows="5" id="leave_comment" placeholder="Message"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-end">
                                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div><!--end card-body-->              --}}
                    </div>
                </div>
                <div class="tab-pane" id="review" role="tabpanel">
                    <div class="card">
                        <div class="card-body border-bottom-dashed pb-4"> 
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <div class="row">
                                        <div class="col-auto">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" class="thumb-md rounded-circle">
                                        </div><!--end col-->
                                        <div class="col">
                                            <div class="bg-light rounded ms-n2 bg-light-alt p-3 py-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-dark fw-semibold mb-1">{{$user->name}} <span class="fw-normal">đã đánh giá <span class="fw-semibold">5</span> sao cho</span> <a href="#" class="text-inherit text-underline">iPhone 15 plus</a></p>
                                                    </div><!--end col-->
                                                    <div class="col-auto">
                                                        <span class="text-muted"><i class="far fa-clock me-1"></i>30 phút trước</span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                                <div class="mb-2 d-flex gap1">
                                                <i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i>
                                                </div>
                                                <p>
                                                    Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm.
                                                </p>
                                                <span class="text-muted">20:05 11/12/2004</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </li>
                                <li class="mt-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" class="thumb-md rounded-circle">
                                        </div><!--end col-->
                                        <div class="col">
                                            <div class="bg-light rounded ms-n2 bg-light-alt p-3 py-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-dark fw-semibold mb-1">{{$user->name}} <span class="fw-normal">đã đánh giá <span class="fw-semibold">4</span> sao cho</span> <a href="#" class="text-inherit text-underline">iPhone 15 plus</a></p>
                                                    </div><!--end col-->
                                                    <div class="col-auto">
                                                        <span class="text-muted"><i class="far fa-clock me-1"></i>30 phút trước</span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                                <div class="mb-2 d-flex gap1">
                                                <i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="far fa-star text-warning fs-star"></i>
                                                </div>
                                                <p>
                                                    Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm.
                                                </p>
                                                <span class="text-muted">20:05 11/12/2004</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </li>
                                <li class="mt-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default.png"}}" alt="" class="thumb-md rounded-circle">
                                        </div><!--end col-->
                                        <div class="col">
                                            <div class="bg-light rounded ms-n2 bg-light-alt p-3 py-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-dark fw-semibold mb-1">{{$user->name}} <span class="fw-normal">đã đánh giá <span class="fw-semibold">3</span> sao cho</span> <a href="#" class="text-inherit text-underline">iPhone 15 plus</a></p>
                                                    </div><!--end col-->
                                                    <div class="col-auto">
                                                        <span class="text-muted"><i class="far fa-clock me-1"></i>30 phút trước</span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                                <div class="mb-2 d-flex gap1">
                                                <i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="fas fa-star text-warning fs-star"></i><i class="far fa-star text-warning fs-star"></i><i class="far fa-star text-warning fs-star"></i>
                                                </div>
                                                <p>
                                                    Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm.
                                                </p>
                                                <span class="text-muted">20:05 11/12/2004</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </li>
                            </ul> 
                        </div><!--end card-body--> 
                    </div>
                </div>
            </div> 
        </div> <!--end col-->                                                       
    </div><!--end row-->

                      
</div><!-- container -->

@section('script')
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        {{-- <script src="assets/libs/tobii/js/tobii.min.js"></script> --}}
        <script src="assets/js/pages/profile.init.js"></script>
@endsection