<div class="container-xxl animated fadeInDown">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <form id="form_filter" method="GET" action="{{ route('order.index') }}" class="row g-2">
                                <div class="col-auto">
                                    <select name="perPage" class="form-select" onchange="submitForm()">
                                        <option {{ request('perPage') == 8 ? 'selected' : '' }} value="8">8 đơn hàng</option>
                                        <option {{ request('perPage') == 10 ? 'selected' : '' }} value="10">10 đơn hàng</option>
                                        <option {{ request('perPage') == 12 ? 'selected' : '' }} value="12">12 đơn hàng</option>
                                        <option {{ request('perPage') == 15 ? 'selected' : '' }} value="15">15 đơn hàng</option>
                                        <option {{ request('perPage') == 18 ? 'selected' : '' }} value="18">18 đơn hàng</option>
                                        {{-- request('perPage'): dữ lại value cũ của perPage --}}
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="orderBy" class="form-select" onchange="submitForm()">
                                        <option {{ request('orderBy') == 'lastest' ? 'selected' : '' }} value="lastest">
                                            Mới nhất</option>
                                        <option {{ request('orderBy') == 'oldest' ? 'selected' : '' }} value="oldest">Cũ
                                            nhất</option>
                                        {{-- request('orderBy'): dữ lại value cũ của orderBy --}}
                                    </select>
                                </div>
                                <div class="col-auto d-flex">
                                    <input type="text" id="keyword-input" class="form-control border-end-0"
                                        name="keyWord" value="{{ request('keyWord') }}" placeholder="Từ khóa..."
                                        style="border-top-right-radius: 0; border-bottom-right-radius: 0">
                                    {{-- request('keyWord'): dữ lại value cũ của keyWord --}}
                                    <button class="btn btn-info text-nowrap"
                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0">Tìm kiếm</button>
                                </div>
                            </form>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all" id="datatable_1">
                            <thead class="table-light">
                              <tr>
                                <th>Mã đơn hàng</th>
                                <th>Sản phẩm</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Tổng tiền</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td><span
                                        class="badge bg-transparent border border-primary text-primary">{{$order->order_code}}</span></td>
                                        <td>
                                            <a href="{{route('order.show', $order->id)}}" class="d-flex">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($order->orderDetails as $index => $orderDetail)
                                            @if ($index < 3)
                                            <div class="mr2 position-relative">
                                                <img src="{{".".Storage::url($orderDetail->product_variant_image)}}" class="rounded" alt="product" height="30">
                                                @if ($orderDetail->quantity > 1)
                                                <div class="bg-primary w-h position-absolute position-quantity rounded-circle text-white d-flex justify-content-center align-items-center">{{$orderDetail->quantity}}</div>
                                                @endif
                                            </div>
                                            @if ($order->orderDetails->count() === 1)
                                            <p class="d-inline-flex mb-0 flex-column ms1">
                                                <span class="d-block mb-0 product-name text-body fs11">{{$orderDetail->product_name}}</span>
                                                <span class="text-muted" style="font-size: 9px">({{$orderDetail->color_name}} - {{$orderDetail->ssd_name}})</span> 
                                            </p>
                                            @endif
                                            @else
                                            @php
                                                $i+=1;
                                            @endphp    
                                            @endif
                                            @endforeach
                                            @if ($i > 0)
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary w-h-20 rounded-circle fs10 d-flex justify-content-center align-items-center text-white">+{{$i}}</div>
                                            </div>
                                            @endif
                                            </a>
                                        </td>
                                    <td>
                                        <div>
                                            <p class="mb-0 product-name">{{$order->user_name}}</p> 
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{date('d/m/Y', strtotime($order->created_at))}}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{$order->payment_method === "cod" ? "purple" : "info"}}-subtle text-{{$order->payment_method === "cod" ? "purple" : "info"}}"><i class="fas fa-{{$order->payment_method === "cod" ? "money-bill-wave" : "money-check"}} me-1"></i> {{$order->payment_method === "cod" ? "Thanh toán khi nhận hàng" : "Thanh toán online"}}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{$order->payment_status === "ctt" ? "danger" : "success"}}-subtle text-{{$order->payment_status === "ctt" ? "danger" : "success"}}"><i class="fas fa-{{$order->payment_status === "ctt" ? "xmark" : "check"}} me-1"></i> {{$order->payment_status === "ctt" ? "Chưa thanh toán" : "Đã thanh toán"}}</span>
                                    </td>
                                    @php
                                        $color = $order->status === "cxn" ? "warning" : ($order->status === "dxn" ? "primary" : ($order->status === "dgh" ? "purple" : ($order->status === "ghtc" ? "success" : ($order->status === "ghtb" ? "danger" : ($order->status === "dh" ? "danger" : "success")))));
                                        $icon = $order->status === "cxn" ? "clock" : ($order->status === "dxn" ? "check" : ($order->status === "dgh" ? "truck" : ($order->status === "ghtc" ? "check-to-slot" : ($order->status === "ghtb" ? "ban" : ($order->status === "dh" ? "xmark" : "thumbs-up")))));
                                    @endphp
                                    <td>
                                        <span class="badge bg-{{$color}}-subtle text-{{$color}}"><i class="fas fa-{{$icon}} me-1"></i> {{$order->status === "cxn" ? "Đang chờ xác nhận" : ($order->status === "dxn" ? "Đã xác nhận" : ($order->status === "dgh" ? "Đang giao hàng" : ($order->status === "ghtc" ? "Giao hành thành công" : ($order->status === "ghtb" ? "Giao hành thất bại" : ($order->status === "dh" ? "Đã hủy" : "Hoàn thành")))))}}</span>
                                    </td>
                                    <td class="text-danger fs-12"><strong>{{number_format($order->total_price, 0, '', '.')}} vnđ</strong></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-danger">Không có đơn hàng nào</td>
                                </tr>
                                @endforelse                                                                           
                            </tbody>
                        </table>
                        <div class="nav-mt-3">
                            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}</div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->