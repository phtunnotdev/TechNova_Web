@include('clients.components.breadcrumb')

<!-- Wishlist Page Start -->
<div class="cart-main-area wish-list ptb-45">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Form Start -->
                <form action="#">
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail">Ảnh</th>
                                    <th class="product-name">Tên sản phẩm</th>
                                    <th class="product-quantity">Trạng thái</th>
                                    <th class="product-subtotal"></th>
                                </tr>
                            </thead>
                            @forelse ($wishlists as $wishlistItem)
                            <tbody>
                                <tr>
                                    <td class="product-remove"> 
                                    <a href="{{ route('client.wishlist.remove', $wishlistItem->id) }}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{ asset('storage/' . $wishlistItem->product->image) }}" alt="cart-image" /></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{$wishlistItem->product->name}}</a></td>
                                    <td class="product-stock-status"><span>Còn hàng</span></td>
                                    <td class="product-add-to-cart"><a href="{{ route('client.product.detail', $wishlistItem->product->id) }}">Xem chi tiết</a></td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!-- Table Content Start -->
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<div class="main-wishlist-page ptb-45">
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-lg-12 order-1 order-lg-2">
                
                <div class="row">
                    @forelse ($wishlists as $wishlistItem)
                        <!-- Single Product Start -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="single-product">
                                <!-- Product Image Start -->
                                <div class="pro-img">
                                    <a href="{{ route('client.product.detail', $wishlistItem->product->id) }}">
                                        <img class="primary-img" src="{{ asset('storage/' . $wishlistItem->product->image) }}" alt="single-product">
                                    </a>
                                </div>
                                <!-- Product Image End -->
                                <!-- Product Content Start -->
                                <div class="pro-content">
                                    <div class="pro-info">
                                        <h4><a href="{{ route('client.product.detail', $wishlistItem->product->id) }}">{{ $wishlistItem->product->name }}</a></h4>
                                        <div class="product-rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa fa-star{{ $i < $wishlistItem->product->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('client.wishlist.remove', $wishlistItem->id) }}" method="POST" class="remove-wishlist-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger remove-btn" title="Xóa khỏi danh sách yêu thích">Xóa</button>
                                </form>
                                <!-- Product Content End -->
                            </div>
                        </div>
                        <!-- Single Product End -->
                    @empty
                        <div class="col-12">
                            <p class="text-danger">Không có sản phẩm yêu thích!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Product Categorie List End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Wishlist Page End -->

@section('modal')
    @include('clients.components.modalshop')
@endsection

<!-- Đảm bảo bạn đã bao gồm thư viện jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
