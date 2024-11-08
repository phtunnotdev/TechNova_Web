@include('clients.components.breadcrumb')

<!-- My Account Page Start Here -->
<div class="my-account white-bg ptb-45">
    <div class="container">
        <div class="account-dashboard">

            <div class="row">
                <div class="col-lg-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mt-all-40">
                        <div class="tab-pane fade show active">
                            <div class="d-flex justify-content-between">
                                <h3>Chi tiết đơn hàng</h3>
                                @if ($order->status === "cxn")
                                <div>
                                    <a href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    <button type="button" class="btn btn-danger">Hủy đơn hàng</button>
                                    </a>
                                </div>
                                @elseif ($order->status === "ghtc")
                                <div>
                                    <form action="{{route('client.confirm', $order->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn đã nhận hàng không ?')">Đã nhận hàng</button>
                                    </form>
                                </div>
                                @else
                                <p class="mb-0 text-{{$order->status === "cxn" ? "warning" : ($order->status === "dxn" ? "info" : ($order->status === "dgh" ? "purple" : ($order->status === "ghtc" ? "success" : ($order->status === "ghtb" ? "danger" : ($order->status === "dh" ? "danger" : "success")))))}}">
                                    {{$order->status === "cxn" ? "Đang chờ xác nhận" : ($order->status === "dxn" ? "Đã xác nhận" : ($order->status === "dgh" ? "Đang giao hàng" : ($order->status === "ghtc" ? "Giao hành thành công" : ($order->status === "ghtb" ? "Giao hành thất bại" : ($order->status === "dh" ? "Đã hủy" : "Đã nhận hàng")))))}}
                                </p>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-detail">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>	 	 	 	
                                            <th>Hành động</th>	 	 	 	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $orderDetail)
                                            <tr>
                                                <td>{{$orderDetail->product_name}} ({{$orderDetail->color_name}} - {{$orderDetail->ssd_name}})</td>
                                                <td><img src="{{".".Storage::url($orderDetail->product_variant_image)}}" class="product-detal-w"/></td>
                                                <td class="text-danger">{{number_format($orderDetail->price, 0, '', '.')}} vnđ</td>
                                                <td>{{$orderDetail->quantity}}</td>
                                                <td class="text-danger">{{number_format($orderDetail->price * $orderDetail->quantity, 0, '', '.')}} vnđ</td>

                                                <!-- Thêm nút Đánh giá nếu trạng thái đơn hàng là đã nhận hàng -->
                                                <td>
                                                    @if ($order->status === "dndh")
                                                        <div class="mt-2 rating-button">
                                                            <button class="btn btn-rate"  data-bs-toggle="modal" data-bs-target="#myModalReviews-{{$orderDetail->id}}">
                                                                <i class="fa fa-star"></i> Đánh giá
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                             <!-- Gọi modalreview.blade.php và truyền dữ liệu -->
                                            @include('clients.components.modalreview', ['orderDetail' => $orderDetail, 'order' => $order])
                                            @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-start">
                                                <p>Tên khách hàng: <span class="text-primary">{{$order->user_name}}</span></p>
                                                <p>email: <span class="text-primary">{{$order->user->email}}</span></p>
                                                <p>Số điện thoại: <span class="text-primary">{{$order->user_phone}}</span></p>
                                                <p>Địa chỉ: <span class="text-primary">{{$order->user_address}}</span></p>
                                                <p>Ghi chú: {{$order->note ?? "Không có ghi chú"}}</p>
                                            </td>
                                            <td class="text-start">
                                                <p>Mã đơn hàng: <span class="text-success fw-bold">{{$order->order_code}}</span></p>
                                                <p>Tổng tiền: <span class="text-danger fw-bold">{{number_format($order->total_price, 0, '', '.')}} vnđ</span></p>
                                                <p>Phươn thức thanh toán: <span class="text-primary">{{$order->payment_method === "cod" ? "Thanh toán khi nhận hàng" : "Thanh toán online"}}</span></p>
                                                <p>Trạng thái thanh toán: <span class="text-{{$order->payment_status === "ctt" ? "danger" : "success"}}">{{$order->payment_status === "ctt" ? "Chưa thanh toán" : "Đã thanh toán"}}</span></p>
                                                <p>Trạng thái đơn hàng: <span class="text-{{$order->status === "cxn" ? "warning" : ($order->status === "dxn" ? "info" : ($order->status === "dgh" ? "purple" : ($order->status === "ghtc" ? "success" : ($order->status === "ghtb" ? "danger" : ($order->status === "dh" ? "danger" : "success")))))}}">{{$order->status === "cxn" ? "Đang chờ xác nhận" : ($order->status === "dxn" ? "Đã xác nhận" : ($order->status === "dgh" ? "Đang giao hàng" : ($order->status === "ghtc" ? "Giao hành thành công" : ($order->status === "ghtb" ? "Giao hành thất bại" : ($order->status === "dh" ? "Đã hủy" : "Đã nhận hàng")))))}}</span></p>

                                                   
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Account Page End Here -->
@section('modal')
@include('clients.components.modalcancel')
@endsection