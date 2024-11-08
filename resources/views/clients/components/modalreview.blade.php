<!-- Quick View Content Start -->
<div class="main-product-thumbnail quick-thumb-content">
    <div class="container">
      <!-- The Modal -->
        <!-- modalreview.blade.php -->

        <!-- Modal đánh giá sản phẩm -->
        <div class="modal fade" id="myModalReviews-{{$orderDetail->id}}" tabindex="-1" aria-labelledby="myModalReviewsLabel-{{$orderDetail->id}}" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalReviewsLabel-{{$orderDetail->id}}">Đánh giá sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('client.review.store', ['orderId' => $order->id, 'orderDetailId' => $orderDetail->id]) }}" method="post">
                                @csrf
                                <!-- Đánh giá bằng sao -->
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Đánh giá:</label>
                                    <div class="star-rating">
                                        <i class="fa-regular fa-star" data-value="1"></i>
                                        <i class="fa-regular fa-star" data-value="2"></i>
                                        <i class="fa-regular fa-star" data-value="3"></i>
                                        <i class="fa-regular fa-star" data-value="4"></i>
                                        <i class="fa-regular fa-star" data-value="5"></i>
                                    </div>
                                    <input type="hidden" name="rating" id="rating-{{$orderDetail->id}}" value="">
                                </div>
                            
                                <!-- Bình luận -->
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Bình luận:</label>
                                    <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Nhập bình luận của bạn"></textarea>
                                </div>
                            
                                <!-- Thêm product_id và order_detail_id -->
                                <input type="hidden" name="product_id" value="{{ $orderDetail->product_id }}">
                                <input type="hidden" name="order_detail_id" value="{{ $orderDetail->id }}">
                                
                                <!-- Nút Gửi Đánh Giá -->
                                <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn gửi đánh giá không?')">Gửi đánh giá</button>
                            </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- Quick View Content End -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const starContainers = document.querySelectorAll('.star-rating');

    starContainers.forEach(container => {
        const stars = container.querySelectorAll('.fa-star');
        const ratingInput = container.closest('.modal').querySelector('input[name="rating"]');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');

                ratingInput.value = value; // Cập nhật giá trị vào input ẩn

                stars.forEach(s => s.classList.remove('selected')); // Xóa hết class "selected"

                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('selected'); // Thêm class "selected" cho các sao được chọn
                }
            });
        });
    });
});


</script>