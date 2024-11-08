<div class="container-xxl animated fadeInDown">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                            <div class="d-flex align-items-center flex-row flex-wrap">
                                <div class="position-relative me-3">
                                    <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default-staff.png"}}" alt="" height="120" class="rounded-circle">
                                    <a href="#" class="thumb-md justify-content-center d-flex align-items-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg">
                                        <i class="fas fa-camera"></i>
                                    </a>
                                </div>
                                <div class="">
                                    <h5 class="fw-semibold fs-20 mb-1">{{$user->name}}</h5>
                                    <p class="mb-0 text-muted mb2">ID: <span class="text-blue fw-medium">{{$user->user_code}}</span></p>
                                    <span class="badge bg-blue-subtle text-blue text-capitalize me-1">Nhân Viên</span>
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
                            <h4 class="card-title">Thông Tin Nhân Viên</h4>                      
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
                        <li class="mt-2"><i class="fas fa-user-tie me-1 text-secondary fs-5 align-middle"></i> <b>&nbsp;&nbsp;Vai trò </b> : Nhân Viên</li>
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
                    <a class="nav-link fw-medium" data-bs-toggle="tab" href="#post" role="tab" aria-selected="false">Bài viết (7)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" data-bs-toggle="tab" href="#customer" role="tab" aria-selected="false">Khách hàng (6)</a>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
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
                                        <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div>
                    </div> 
                </div>                                                
                <div class="tab-pane" id="post" role="tabpanel">
                    <div id="grid" class="row pb-3 g-3">
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <img src="assets/images/extra/card/img-1.jpg" class="img-fluid rounded-start" alt="...">
                                    </div><!--end col-->
                                    <div class="col-7">
                                        <div class="card-body p-2 d-flex h-100 flex-column">
                                        <h5 class="card-title mb-1">Bài viết về iPhone 15</h5>
                                        <div class="d-flex flex-column justify-content-between flex-1">
                                            <p class="card-text mb-0">
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-outline-primary btn-sm fw-normal">Xem chi tiết</a>    
                                                    <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <img src="assets/images/extra/card/img-2.jpg" class="img-fluid rounded-start" alt="...">
                                    </div><!--end col-->
                                    <div class="col-7">
                                        <div class="card-body p-2 d-flex h-100 flex-column">
                                        <h5 class="card-title mb-1">Bài viết về iPhone 15</h5>
                                        <div class="d-flex flex-column justify-content-between flex-1">
                                            <p class="card-text mb-0">
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-outline-primary btn-sm fw-normal">Xem chi tiết</a>    
                                                    <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <img src="assets/images/extra/card/img-3.jpg" class="img-fluid rounded-start" alt="...">
                                    </div><!--end col-->
                                    <div class="col-7">
                                        <div class="card-body p-2 d-flex h-100 flex-column">
                                        <h5 class="card-title mb-1">Bài viết về iPhone 15</h5>
                                        <div class="d-flex flex-column justify-content-between flex-1">
                                            <p class="card-text mb-0">
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-outline-primary btn-sm fw-normal">Xem chi tiết</a>    
                                                    <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <img src="assets/images/extra/card/img-4.jpg" class="img-fluid rounded-start" alt="...">
                                    </div><!--end col-->
                                    <div class="col-7">
                                        <div class="card-body p-2 d-flex h-100 flex-column">
                                        <h5 class="card-title mb-1">Bài viết về iPhone 15</h5>
                                        <div class="d-flex flex-column justify-content-between flex-1">
                                            <p class="card-text mb-0">
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-outline-primary btn-sm fw-normal">Xem chi tiết</a>    
                                                    <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <img src="assets/images/extra/card/img-5.jpg" class="img-fluid rounded-start" alt="...">
                                    </div><!--end col-->
                                    <div class="col-7">
                                        <div class="card-body p-2 d-flex h-100 flex-column">
                                        <h5 class="card-title mb-1">Bài viết về iPhone 15</h5>
                                        <div class="d-flex flex-column justify-content-between flex-1">
                                            <p class="card-text mb-0">
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-outline-primary btn-sm fw-normal">Xem chi tiết</a>    
                                                    <span class="badge bg-primary-subtle text-primary">20/11/2024</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane" id="customer" role="tabpanel">
                    <div class="row justify-content-center pb-3 g-2">
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-0">                                
                                <div class="card-body p-2">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle w-100">
                                        </div>
                                        <div class="col-7 d-flex flex-column justify-content-center">
                                            <div>
                                                <h4 class="mb-1 fw-semibold fs-6 text-truncate">Kathryn Money</h4>
                                                <p class="text-muted mb-3 fs10 text-truncate">grant.brad@example.net</p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary fs10"><i class="fab fa-facebook-messenger me-1"></i>Nhắn tin</button>
                                            </div>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-0">                                
                                <div class="card-body p-2">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle w-100">
                                        </div>
                                        <div class="col-7 d-flex flex-column justify-content-center">
                                            <div>
                                                <h4 class="mb-1 fw-semibold fs-6 text-truncate">Anthony Stover</h4>
                                                <p class="text-muted mb-3 fs10 text-truncate">ubraun@example.org</p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary fs10"><i class="fab fa-facebook-messenger me-1"></i>Nhắn tin</button>
                                            </div>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-0">                                
                                <div class="card-body p-2">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle w-100">
                                        </div>
                                        <div class="col-7 d-flex flex-column justify-content-center">
                                            <div>
                                                <h4 class="mb-1 fw-semibold fs-6 text-truncate">Catherine Orman</h4>
                                                <p class="text-muted mb-3 fs10 text-truncate">ernesto.abshire@example.org</p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary fs10"><i class="fab fa-facebook-messenger me-1"></i>Nhắn tin</button>
                                            </div>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-0">                                
                                <div class="card-body p-2">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle w-100">
                                        </div>
                                        <div class="col-7 d-flex flex-column justify-content-center">
                                            <div>
                                                <h4 class="mb-1 fw-semibold fs-6 text-truncate">Catherine Orman</h4>
                                                <p class="text-muted mb-3 fs10 text-truncate">ernesto.abshire@example.org</p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary fs10"><i class="fab fa-facebook-messenger me-1"></i>Nhắn tin</button>
                                            </div>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->            
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-0">                                
                                <div class="card-body p-2">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle w-100">
                                        </div>
                                        <div class="col-7 d-flex flex-column justify-content-center">
                                            <div>
                                                <h4 class="mb-1 fw-semibold fs-6 text-truncate">Catherine Orman</h4>
                                                <p class="text-muted mb-3 fs10 text-truncate">ernesto.abshire@example.org</p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary fs10"><i class="fab fa-facebook-messenger me-1"></i>Nhắn tin</button>
                                            </div>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->            
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-0">                                
                                <div class="card-body p-2">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <img src="assets/images/users/avatar-9.jpg" alt="" class="rounded-circle w-100">
                                        </div>
                                        <div class="col-7 d-flex flex-column justify-content-center">
                                            <div>
                                                <h4 class="mb-1 fw-semibold fs-6 text-truncate">Catherine Orman</h4>
                                                <p class="text-muted mb-3 fs10 text-truncate">ernesto.abshire@example.org</p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary fs10"><i class="fab fa-facebook-messenger me-1"></i>Nhắn tin</button>
                                            </div>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->                                                                  
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