@include('clients.components.breadcrumb')
<!-- My Account Page Start Here -->
<div class="checkout-area pb-45 pt-15">
    <div class="container">
        <div class="your-order">
            <h3 class="text-center text-pri">Thanh toán thành công!</h3>
            <div class="text-center check-auth">
                <i class="fa-regular fa-circle-check"></i>
            </div>
            <p class="text-center pb-3 pt-3">
                Cảm ơn bạn đã mua sắm tại cửa hàng đồ điện tử TechNoVa! <br>
                Thanh toán đã được thực hiện thành công. Chúng tôi rất vui khi được phục vụ bạn và hy vọng bạn sẽ hài lòng với sản phẩm của mình.
            </p>
            <div class="text-center mt-3">
                <a href="{{ route('client.shop') }}" class="btn btn-outline-success mx-2">Tiếp tục mua sắm</a>
                @php
                    $order = DB::table('orders')->where('user_id', Auth::id())->orderByDesc('created_at')->first();
                @endphp
                <a href="{{route('client.order.detail', $order->id)}}" class="btn btn-outline-primary mx-2">Chi tiết đơn hàng</a>
            </div> 
        </div>
    </div>
</div>
<!-- My Account Page End Here -->