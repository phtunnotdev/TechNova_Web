@include('clients.components.breadcrumb')
<!-- coupon-area start -->
<div class="coupon-area pt-45">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    <h3>Bạn có mã giảm giá không? <span id="showcoupon">Nhấp vào để nhập mã.</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="{{route('client.checkouts.checkout')}}" method="GET">
                                <p class="checkout-coupon">
                                    <input type="text" name="coupon_code" class="code" placeholder="Mã giảm giá" required />
                                    <input type="submit" value="Áp dụng" />
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->

<!-- checkout-area start -->
<div class="checkout-area pb-45 pt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <!-- Form chi tiết thanh toán -->
                <form action="{{ route('client.checkouts.process') }}" method="POST">
                    @csrf
                    <div class="checkbox-form mb-sm-40">
                        <h3>Chi tiết thanh toán</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Họ và tên <span class="required">*</span></label>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" placeholder="Họ và tên" />
                                    @if ($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Địa chỉ <span class="required">*</span></label>
                                    <input type="text" name="address" value="{{Auth::user()->address}}" placeholder="Địa chỉ" />
                                    @if ($errors->has('address'))
                                        <div class="text-danger">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Số điện thoại <span class="required">*</span></label>
                                    <input type="text" name="phone" value="{{Auth::user()->phone}}" placeholder="Số điện thoại" />
                                    @if ($errors->has('phone'))
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="different-address">
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Ghi chú</label>
                                    <textarea name="note" id="checkout-mess" cols="30" rows="10"
                                        placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt khi giao hàng."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Đơn hàng của bạn</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-total">Giá tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <img src="{{".".Storage::url($cart->productVariant->image) }}" alt="Ảnh"
                                                    style="width: 50px; height: 50px; margin-right: 10px; vertical-align: middle;">
                                                {{ $cart->productVariant->product->name }}({{ $cart->productVariant->ssd->name }} - {{ $cart->productVariant->color->name }}) <span class="product-quantity"> ×
                                                    {{ $cart->variant_quantity }}</span>
                                            </td>
                                            <td class="product-total">
                                                @if ($voucher)
                                                <span
                                                class="amount">{{ number_format(($cart->productVariant->price * $cart->variant_quantity * $voucher->percent / 100), 0, '', '.') }}
                                                vnđ</span> <span class="text-danger fw-bold" style="font-size: 10px">-{{$voucher->percent}}%</span>
                                                @else
                                                <span
                                                class="amount">{{ number_format($cart->productVariant->price * $cart->variant_quantity, 0, '', '.') }}
                                                vnđ</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Tạm tính</th>
                                        @php
                                            $total = $carts->sum(function ($cart) {return $cart->productVariant->price * $cart->variant_quantity;});
                                        @endphp
                                        <td>
                                            @if ($voucher)
                                            <span
                                                class="amount">{{ number_format( $total * $voucher->percent / 100 ,0,'','.') }}
                                                vnđ</span>
                                            @else
                                            <span
                                                class="amount">{{ number_format($total,0,'','.') }}
                                                vnđ</span>
                                            @endif
                                        </td>    
                                    </tr>
                                    <tr class="order-total">
                                        <th>Tổng</th>
                                        <td>
                                            @if ($voucher)
                                            <span
                                                class="amount">{{ number_format( $total * $voucher->percent / 100 ,0,'','.') }}
                                                vnđ</span>
                                            @else
                                            <span
                                                class="amount">{{ number_format($total,0,'','.') }}
                                                vnđ</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
<<<<<<< HEAD
                            <div class="payment-method">
                                <div class="mb-3">
                                    <h3>Chọn phương thức thanh toán:</h3>
                                    <div class="form-check border rounded p-3 mb-3 bg-white">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentCOD" value="cod">
                                        <label class="form-check-label" for="paymentCOD">
                                            Thanh toán khi nhận hàng
                                        </label>
                                        <div class="form-text">
                                            Khách hàng thanh toán tiền mặt khi nhận được sản phẩm.
                                        </div>
=======
                        @if ($voucher)
                        <input type="hidden" name="voucher" value="{{$voucher->percent}}">
                        <input type="hidden" name="id_voucher" value="{{$voucher->id}}">
                        @endif
                        <div class="payment-method">
                            <div class="mb-3">
                                <h3>Chọn phương thức thanh toán:</h3>
                                <div class="form-check border rounded p-3 mb-3 bg-white">
                                    <input class="form-check-input" type="radio" checked name="paymentMethod" id="paymentVnpay"
                                        value="cod">
                                    <label class="form-check-label" for="paymentCOD">
                                        Thanh toán khi nhận hàng
                                    </label>
                                    <div class="form-text">
                                        Khách hàng thanh toán tiền mặt khi nhận được sản phẩm.
>>>>>>> 559a994a31e61881df1d8d7370cc0ea5ce2532ef
                                    </div>
                                    <div class="form-check border rounded p-3 mb-3 bg-white">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentVnpay" value="online">
                                        <label class="form-check-label" for="paymentVnpay">
                                            Thanh toán Online
                                        </label>
                                        <div class="form-text">
                                            Thanh toán qua ví VnPay nhanh chóng và an toàn.
                                        </div>
                                    </div>

                                    @if ($errors->has('paymentMethod'))
                                        <div class="text-danger">
                                            {{ $errors->first('paymentMethod') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="btn-checkout text-center">
                                    <button type="submit" class="btn btn-success">Thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->