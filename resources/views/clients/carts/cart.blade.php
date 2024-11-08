
<!-- Cart Main Area Start -->
<div class="cart-main-area ptb-45">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!-- Form Start -->
                <form action="{{ route('client.updateCart') }}" method="POST">
                    @csrf
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive mb-45">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Hình Ảnh</th>
                                    <th class="product-name">Sản Phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng Tiền</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            <img src="{{ ".".Storage::url($cart->productVariant->image) }}" alt="cart-image" />
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="#">{{ $cart->productVariant->product->name }} ({{ $cart->productVariant->color->name }} - {{ $cart->productVariant->ssd->name }})</a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">{{ number_format($cart->productVariant->price, 0, '', '.') }} vnđ</span>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                            <button class="btn btn-secondary" type="button" onclick="updateQuantity(this, -1)">-</button>
                                            <input type="number" name="quantities[{{ $cart->id }}]" value="{{ $cart->variant_quantity }}" class="quantity-prd mx-2" min="1" />
                                            <button class="btn btn-secondary" type="button" onclick="updateQuantity(this, 1)">+</button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        {{ number_format($cart->productVariant->price * $cart->variant_quantity, 0, '', '.') }} vnđ
                                    </td>
                                    <td class="product-remove">
                                        <a href="{{route('client.removeFromCart', $cart->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content End -->
                    <div class="row">
                        <!-- Cart Button Start -->
                        <div class="col-md-8 col-sm-12">
                            <div class="buttons-cart">
                                <input type="submit" value="Cập nhật giỏ hàng" class="btn btn-primary" />
                                <a href="{{ route('client.index') }}" class="btn btn-secondary">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                        <!-- Cart Button End -->
                        <!-- Cart Totals Start -->
                        <div class="col-md-4 col-sm-12">
                            <div class="cart_totals float-md-right text-md-right">
                                <h2>Tổng Giỏ Hàng</h2>
                                <br />
                                <table class="float-md-right">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th class="text-start">Tạm Tính</th>
                                            <td class="text-end">
                                                <span class="amount">{{ number_format($carts->sum(function($cart) { return $cart->productVariant->price * $cart->variant_quantity; }), 0, '', '.') }} vnđ</span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="text-start">Tổng Tiền</th>
                                            <td class="text-end">
                                                <strong>
                                                    <span class="amount">{{ number_format($carts->sum(function($cart) { return $cart->productVariant->price * $cart->variant_quantity; }), 0, '', '.') }} vnđ</span>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    <a href="{{ route('client.checkouts.checkout') }}" class="btn btn-success">Tiến Hành Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                        <!-- Cart Totals End -->
                    </div>
                    <!-- Row End -->
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>

<script>
function updateQuantity(button, change) {
    const input = button.parentElement.querySelector('input[type="number"]');
    let quantity = parseInt(input.value);
    if (quantity + change > 0) {
        input.value = quantity + change;
    }
}
</script>   

<!-- Cart Main Area End -->
