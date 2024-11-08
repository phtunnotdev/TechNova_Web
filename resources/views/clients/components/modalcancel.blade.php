<!-- Quick View Content Start -->
<div class="main-product-thumbnail quick-thumb-content">
    <div class="container">
      <!-- The Modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <button
                type="button"
                class="close ms-auto fs-1 bg-transparent border-0"
                data-bs-dismiss="modal"
              >
                &times;
              </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5 class="mb-3">Lý do hủy đơn hàng</h5>
                <form action="{{route('client.cancel', $order->id)}}" method="post">
                @csrf
              <div class="row">
                <div class="col-5">
                    <div class="mb-1">
                        <input type="radio" name="noteModel" value="Thay đổi ý định mua hàng"> Thay đổi ý định mua hàng                  
                     </div>
                     <div class="mb-1">
                         <input type="radio" name="noteModel" value="Tìm thấy giá tốt hơn ở nơi khác"> Tìm thấy giá tốt hơn ở nơi khác                  
                      </div>
                      <div class="mb-1">
                         <input type="radio" name="noteModel" value="Thay đổi về địa chỉ giao hàng"> Thay đổi về địa chỉ giao hàng                  
                      </div>
                      <div class="mb-1">
                         <input type="radio" name="noteModel" value="Đặt nhầm sản phẩm"> Đặt nhầm sản phẩm                  
                      </div>
                </div>
                <div class="col-2">Hoặc</div>
                <div class="col-5">
                    <textarea name="note" rows="2" class="form-control w-100 mb-2" placeholder="Nhập lý do của bạn"></textarea>
                    @if ($order->payment_method === "cod")
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắc muốn hủy không ?')">Hủy đơn hàng</button>
                    @else
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Nếu bạn hủy bạn sẽ không được hoàn tiền ?')">Hủy đơn hàng</button>
                    @endif
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Quick View Content End -->