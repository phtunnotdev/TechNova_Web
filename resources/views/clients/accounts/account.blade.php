@include('clients.components.breadcrumb')
<!-- My Account Page Start Here -->
<div class="my-account white-bg ptb-45">
    <div class="container">
        <div class="account-dashboard">

            <div class="row">
                <div class="col-lg-2">
                    <!-- Nav tabs -->
                    <ul class="nav flex-column dashboard-list" role="tablist">

                        <li> <a class="nav-link active" data-bs-toggle="tab" href="#orders">Đơn hàng</a></li>

                        <li><a class="nav-link" data-bs-toggle="tab" href="#address">Địa chỉ</a></li>
                        <li><a class="nav-link" data-bs-toggle="tab" href="#account-details">Chi tiết tài khoản</a></li>
                        <li><a class="nav-link" href="login.html" href="#logout">Đăng xuất</a></li>
                    </ul>
                </div>
                <div class="col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mt-all-40">

                        <div id="orders" class="tab-pane fade show active">
                            <h3>Đơn hàng</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Trạng thái thanh toán</th>
                                            <th>Trạng thái đơn hàng</th>	 	 	 	
                                            <th>Tổng tiền</th>	 	 	 	
                                            <th>Xem</th>	 	 	 	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                        <tr>
                                            <td>{{$order->order_code}}</td>
                                            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                            <td>{{$order->payment_method === "cod" ? "Thanh toán khi nhận hàng" : "Thanh toán online"}}</td>
                                            <td class="text-{{$order->payment_status === "ctt" ? "danger" : "success"}}">{{$order->payment_status === "ctt" ? "Chưa thanh toán" : "Đã thanh toán"}}</td>
                                            <td class="text-{{$order->status === "cxn" ? "warning" : ($order->status === "dxn" ? "info" : ($order->status === "dgh" ? "purple" : ($order->status === "ghtc" ? "success" : ($order->status === "ghtb" ? "danger" : ($order->status === "dh" ? "danger" : "success")))))}}">{{$order->status === "cxn" ? "Đang chờ xác nhận" : ($order->status === "dxn" ? "Đã xác nhận" : ($order->status === "dgh" ? "Đang giao hàng" : ($order->status === "ghtc" ? "Giao hành thành công" : ($order->status === "ghtb" ? "Giao hành thất bại" : ($order->status === "dh" ? "Đã hủy" : "Đã nhận hàng")))))}}</td>
                                            <td class="text-danger fw-bold">{{number_format($order->total_price, 0, '', '.')}} vnđ</td>
                                            <td><a class="view" href="{{route('client.order.detail', $order->id)}}">Xem</a></td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="address" class="tab-pane">
                            <label for="" class="form-label">Địa chỉ</label>
                            <textarea name="" id="" cols="5" rows="5" class="form-control"></textarea>

                            <a class="view" href="#">Cập nhật</a>

                        </div>
                        <div id="account-details" class="tab-pane fade">
                            <h3>Chi tiết tài khoản </h3>
                            <div class="register-form login-form clearfix">
                                <form action="#">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-md-4 col-form-label">Giới tính</label>
                                        <div class="col-lg-6 col-md-8">
                                            <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Nam</span>
                                            <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Nữ</span>
                                            <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Khác</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="f-name" class="col-lg-3 col-md-4 col-form-label">Họ</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="f-name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="l-name" class="col-lg-3 col-md-4 col-form-label">Tên</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="l-name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-lg-3 col-md-4 col-form-label">Email</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputpassword" class="col-lg-3 col-md-4 col-form-label">Mật khẩu cũ</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="password" class="form-control" id="inputpassword">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpassword" class="col-lg-3 col-md-4 col-form-label">Mật khẩu mới</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="password" class="form-control" id="newpassword">
                                            <button class="btn show-btn" type="button">Hiển thị</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="v-password" class="col-lg-3 col-md-4 col-form-label">Xác nhận mật khẩu</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="password" class="form-control" id="c-password">
                                            <button class="btn show-btn" type="button">Hiển thị</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="birth" class="col-lg-3 col-md-4 col-form-label">Ngày sinh</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="birth" placeholder="MM/DD/YYYY">
                                        </div>
                                    </div>


                                    <div class="register-box mt-40">
                                        <button type="submit" class="return-customer-btn float-right">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Account Page End Here -->
