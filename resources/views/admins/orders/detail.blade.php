<div class="container-xxl animated fadeInDown"> 
    <div class="row">
        <div class="col-lg-8">
            
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title text-primary">{{$order->order_code}}</h4>  
                            <p class="mb-0 text-muted mt-1">Ngày đặt: {{date('d/m/Y', strtotime($order->created_at))}}</p>                    
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                              <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $orderDetail)
                                <tr>
                                    <td>
                                        <img src="{{".".Storage::url($orderDetail->product_variant_image)}}" alt="" height="40">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="d-block align-middle mb-0 product-name text-body">{{$orderDetail->product_name}}</span>
                                            <span class="text-muted font-13">({{$orderDetail->color_name}} - {{$orderDetail->ssd_name}})</span> 
                                        </p>
                                    </td>
                                    <td>{{number_format($orderDetail->price, 0, '', '.')}} vnđ</td>
                                    <td>{{$orderDetail->quantity}}</td>                                                    
                                    <td class="text-danger">{{number_format($orderDetail->price * $orderDetail->quantity, 0, '', '.')}} vnđ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--card-body-->
            </div><!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Trạng thái đơn hàng</h4>                      
                        </div><!--end col-->
                        <div class="col-auto">                      
                            <span class="text-muted">Thời gian đặt hàng: <span class="text-primary">{{date('H:i:s d/m/Y', strtotime($order->created_at))}}</span></span>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    @forelse ($order->orderHistories as $orderHistory)
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="row align-items-center">
                                <div class="col-12 d-flex align-items-center">
                                    @php
                                        $iconFrom = $orderHistory->from_status === "cxn" ? "clock" : ($orderHistory->from_status === "dxn" ? "check" : ($orderHistory->from_status === "dgh" ? "truck" : ($orderHistory->from_status === "ghtc" ? "check-to-slot" : ($orderHistory->from_status === "ghtb" ? "ban" : ($orderHistory->from_status === "dh" ? "xmark" : "thumbs-up")))));
                                        $iconTo = $orderHistory->to_status === "cxn" ? "clock" : ($orderHistory->to_status === "dxn" ? "check" : ($orderHistory->to_status === "dgh" ? "truck" : ($orderHistory->to_status === "ghtc" ? "check-to-slot" : ($orderHistory->to_status === "ghtb" ? "ban" : ($orderHistory->to_status === "dh" ? "xmark" : "thumbs-up")))));
                                    @endphp
                                    <div class="bg-{{$orderHistory->from_status !== "dh" && $orderHistory->from_status !== "ghtb" ? "primary" : "danger"}} text-white rounded-pill thumb-md"><i class="fas fa-{{$iconFrom}}"></i></div>
                                    <div class="d-flex flex-column" style="width: 250px;">
                                        <div class="border-primary mx3 w-100" style="border: 1px dashed"></div>
                                    </div>
                                    <div class="bg-{{$orderHistory->to_status !== "dh" && $orderHistory->to_status !== "ghtb" ? "primary" : "danger"}} text-white rounded-pill thumb-md"><i class="fas fa-{{$iconTo}}"></i></div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="text-start">
                                        <h6 class="mb-1">{{$orderHistory->from_status === "cxn" ? "Đang chờ xác nhận" : ($orderHistory->from_status === "dxn" ? "Đã xác nhận" : ($orderHistory->from_status === "dgh" ? "Đang giao hàng" : ($orderHistory->from_status === "ghtc" ? "Giao hành thành công" : ($orderHistory->from_status === "ghtb" ? "Giao hành thất bại" : ($orderHistory->from_status === "dh" ? "Đã hủy" : "Hoàn thành")))))}}</h6>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-1">{{$orderHistory->to_status === "cxn" ? "Đang chờ xác nhận" : ($orderHistory->to_status === "dxn" ? "Đã xác nhận" : ($orderHistory->to_status === "dgh" ? "Đang giao hàng" : ($orderHistory->to_status === "ghtc" ? "Giao hàng thành công" : ($orderHistory->to_status === "ghtb" ? "Giao hàng thất bại" : ($orderHistory->to_status === "dh" ? "Đã hủy" : "Hoàn thành")))))}}</h6>
                                        <p class="mb-0 text-muted fs-12 fw-medium">{{date('H:i:s d/m/Y', strtotime($orderHistory->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex flex-column">
                            <div class="bg-{{$orderHistory->to_status !== "dh" && $orderHistory->to_status !== "ghtb" ? "primary" : "danger"}}-subtle p-2 border-dashed border-{{$orderHistory->to_status !== "dh" && $orderHistory->to_status !== "ghtb" ? "primary" : "danger"}} rounded">
                            <span class="text-{{$orderHistory->to_status !== "dh" && $orderHistory->to_status !== "ghtb" ? "primary" : "danger"}} fw-semibold">{{$orderHistory->to_status === "dh" ? "Lý do:" : "Ghi chú:"}}</span><span class="text-{{$orderHistory->to_status !== "dh" && $orderHistory->to_status !== "ghtb" ? "primary" : "danger"}} fw-normal"> {{$orderHistory->note ?? "Không có ghi chú"}}</span>
                            @php
                                $user = DB::table('users')->find($orderHistory->by_user);
                            @endphp
                            </div>
                            <span class="text-end fs10 mt1 text-{{$orderHistory->to_status !== "dh" && $orderHistory->to_status !== "ghtb" ? "primary" : "danger"}}">{{$user->name}} <span class="text-muted">đã thay đổi</span></span>
                        </div>
                    </div>
                    @empty
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="row align-items-center">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-pill thumb-md"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="text-start">
                                        <h6 class="mb-1">Đang chờ xác nhận</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                    @if ($order->status !== "ghtc" &&  $order->status !== "dndh" && $order->status !== "dh")
                    <form action="{{route('order.update', $order->id)}}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-auto">
                                @php
                                    $dh = $order->status !== "cxn" && $order->status !== "ghtb" ? "disabled" : "";
                                    $dxn = $order->status !== "cxn" ? "disabled" : "";
                                    $dgh = $order->status !== "dxn" ? "disabled" : "";
                                    $ghtc = $order->status !== "dgh" ? "disabled" : "";
                                    $ghtb = $order->status !== "dgh"  ? "disabled" : "";
                                @endphp
                                <select name="status" class="form-select">
                                    <option {{$order->status === "cxn" ? "selected" : ""}} disabled value="cxn">Đang chờ xác nhận</option>
                                    <option {{$order->status === "dxn" ? "selected" : ""}} {{$dxn}} value="dxn">Đã xác nhận</option>
                                    <option {{$order->status === "dgh" ? "selected" : ""}} {{$dgh}} value="dgh">Đang giao hàng</option>
                                    <option {{$order->status === "ghtc" ? "selected" : ""}} {{$ghtc}} value="ghtc">Giao hàng thành công</option>
                                    <option {{$order->status === "ghtb" ? "selected" : ""}} {{$ghtb}} value="ghtb">Giao hàng thất bại</option>
                                    <option {{$order->status === "dh" ? "selected" : ""}} {{$dh}} value="dh">Hủy</option>
                                </select>
                                @if ($errors->has("status"))
                                <p class="text-danger mt-1 mb-0">{{$errors->first("status")}}</p>
                                @endif
                            </div>
                            <div class="col">
                                <textarea name="note" class="form-control w-100" placeholder="Ghi chú" rows="3"></textarea>
                                @if ($errors->has("note"))
                                <p class="text-danger mt-1 mb-0">{{$errors->first("note")}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
                        </div>
                    </form>
                    @endif
                </div><!--card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thông tin thanh toán</h4>                      
                        </div><!--end col-->
                        <div class="col-auto">
                                @php
                                    $color = $order->status === "cxn" ? "warning" : ($order->status === "dxn" ? "primary" : ($order->status === "dgh" ? "purple" : ($order->status === "ghtc" ? "success" : ($order->status === "ghtb" ? "danger" : ($order->status === "dh" ? "danger" : "success")))));
                                    $icon = $order->status === "cxn" ? "clock" : ($order->status === "dxn" ? "check" : ($order->status === "dgh" ? "truck" : ($order->status === "ghtc" ? "check-to-slot" : ($order->status === "ghtb" ? "ban" : ($order->status === "dh" ? "xmark" : "thumbs-up")))));
                                @endphp                      
                            <span class="badge rounded text-{{$color}} bg-{{$color}}-subtle fs-12 p-1">
                                <span>{{$order->status === "cxn" ? "Đang chờ xác nhận" : ($order->status === "dxn" ? "Đã xác nhận" : ($order->status === "dgh" ? "Đang giao hàng" : ($order->status === "ghtc" ? "Giao hành thành công" : ($order->status === "ghtb" ? "Giao hành thất bại" : ($order->status === "dh" ? "Đã hủy" : "Hoàn thành")))))}}</span>
                            </span>                  
                        </div><!--end col-->    
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div>
                        <div class="d-flex justify-content-between">
                          <p class="text-body fw-semibold">Phương thức thanh toán :</p>
                          <p class="text-body-emphasis fw-semibold text-uppercase">{{$orderDetail->order->payment_method}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                          <p class="text-body fw-semibold">Trạng thái thanh toán :</p>
                          <p class="text-{{$orderDetail->order->payment_status === "ctt" ? "danger" : "success"}} fw-semibold">{{$orderDetail->order->payment_status === "ctt" ? "Chưa thanh toán" : "Đã thanh toán"}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold">Ghi chú :</p>
                            <p class="text-muted">{{$order->note ?? "Không có ghi chú"}}</p>
                          </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Tổng cộng :</h4>
                        <h4 class="mb-0 text-danger">{{number_format($orderDetail->order->total_price, 0, '', '.')}} vnđ</h4>
                      </div>
                </div><!--card-body-->
            </div><!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thông tin khách hàng</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                          <p class="text-body fw-semibold"><i class="iconoir-profile-circle text-secondary fs-20 align-middle me-1"></i>Họ và tên :</p>
                          <p class="text-body-emphasis fw-semibold">{{$orderDetail->order->user_name}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-people-tag text-secondary fs-20 align-middle me-1"></i>Số điện thoại :</p>
                            <p class="text-body-emphasis fw-semibold">{{$orderDetail->order->user_phone}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold text-nowrap"><i class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>Địa chỉ :</p>&nbsp;
                            <p class="text-body-emphasis fw-semibold fs-12" style="text-align: justify">{{$orderDetail->order->user_address}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-calendar text-secondary fs-20 align-middle me-1"></i>Ngày đặt :</p>
                            <p class="text-body-emphasis fw-semibold">{{date('d/m/Y', strtotime($order->created_at))}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold"><i class="iconoir-dollar-circle text-secondary fs-20 align-middle me-1"></i>Tổng tiền :</p>
                            <p class="text-body-emphasis fw-semibold"><span class="text-primary">{{number_format($orderDetail->order->total_price, 0, '', '.')}} vnđ</span></p>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->                                       
</div><!-- container -->