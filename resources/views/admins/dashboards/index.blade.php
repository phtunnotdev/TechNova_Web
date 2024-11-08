<div class="container-xxl animated fadeInDown">
  <form action="{{route("admin.index")}}" method="GET">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Thống kê đơn hàng</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="row">
        <div class="col-md-12 col-lg-2">
          <div class="card">
            <div class="card-body border-dashed-bottom pb-3">
              <div class="row d-flex justify-content-between">  
                <div class="col-auto d-flex align-items-center">
                  <div class="text-warning">
                    <h5 class="mb-1 fs-12">Đang chờ xác nhận</h5>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-clock me-1"></i><p class="mb-0 fs11">{{$countCxn < 10 && $countCxn > 0 ? "0".$countCxn : $countCxn}} đơn hàng</p>
                    </div>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-12 col-lg-2">
          <div class="card">
            <div class="card-body border-dashed-bottom pb-3">
              <div class="row d-flex justify-content-between">
                <div class="col-auto d-flex align-items-center">
                  <div class="text-primary">
                    <h5 class="mb1 fs-12">Đã xác nhận</h5>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-check me-1"></i><p class="mb-0 fs11">{{$countDxn < 10 && $countDxn > 0 ? "0".$countDxn : $countDxn}} đơn hàng</p>
                    </div>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-12 col-lg-2">
          <div class="card">
            <div class="card-body border-dashed-bottom pb-3">
              <div class="row d-flex justify-content-between">
                <div class="col-auto d-flex align-items-center">
                  <div class="text-purple">
                    <h5 class="mb1 fs-12">Đang giao hàng</h5>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-truck me-1"></i><p class="mb-0 fs11">{{$countDgh < 10 && $countDgh > 0 ? "0".$countDgh : $countDgh}} đơn hàng</p>
                    </div>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-12 col-lg-2">
          <div class="card">
            <div class="card-body border-dashed-bottom pb-3">
              <div class="row d-flex justify-content-between">
                <div class="col-auto d-flex align-items-center">
                  <div class="text-success">
                    <h5 class="mb1 fs-12">Giao hàng thành công</h5>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-check-to-slot me-1"></i><p class="mb-0 fs11">{{$countGhtc < 10 && $countGhtc > 0 ? "0".$countGhtc : $countGhtc}} đơn hàng</p>
                    </div>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-12 col-lg-2">
          <div class="card">
            <div class="card-body border-dashed-bottom pb-3">
              <div class="row d-flex justify-content-between">
                <div class="col-auto d-flex align-items-center">
                  <div class="text-danger">
                    <h5 class="mb1 fs-12">Giao hàng thất bại</h5>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-ban me-1"></i><p class="mb-0 fs11">{{$countGhtb < 10 && $countGhtb > 0 ? "0".$countGhtb : $countGhtb}} đơn hàng</p>
                    </div>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-12 col-lg-2">
          <div class="card">
            <div class="card-body border-dashed-bottom pb-3">
              <div class="row d-flex justify-content-between">
                <div class="col-auto d-flex align-items-center">
                  <div class="text-danger">
                    <h5 class="mb1 fs-12">Đã hủy</h5>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-xmark me-1"></i><p class="mb-0 fs11">{{$countDh < 10 && $countDh > 0 ? "0".$countDh : $countDh}} đơn hàng</p>
                    </div>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!--end col-->
      </div>
      <!--end row-->
    </div>
    <!--end col-->
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h4 class="card-title">Thống kê doanh thu</h4>
            </div>
            <div class="col-auto px-1">
              <select class="form-select cursor-pointer" id="year" name="year" onchange="updateDays()">
                <option value="0">Chọn năm</option>
                @foreach ($years as $year)
                <option {{request('year') == $year ? "selected" : ""}} value="{{$year}}">Năm {{$year}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-auto px-1">
              <select class="form-select cursor-pointer" id="month" name="month" onchange="updateDays()">
                <option value="0">Chọn tháng</option>
                <option {{request('month') === "01" ? "selected" : ""}} value="01">Tháng 01</option>
                <option {{request('month') === "02" ? "selected" : ""}} value="02">Tháng 02</option>
                <option {{request('month') === "03" ? "selected" : ""}} value="03">Tháng 03</option>
                <option {{request('month') === "04" ? "selected" : ""}} value="04">Tháng 04</option>
                <option {{request('month') === "05" ? "selected" : ""}} value="05">Tháng 05</option>
                <option {{request('month') === "06" ? "selected" : ""}} value="06">Tháng 06</option>
                <option {{request('month') === "07" ? "selected" : ""}} value="07">Tháng 07</option>
                <option {{request('month') === "08" ? "selected" : ""}} value="08">Tháng 08</option>
                <option {{request('month') === "09" ? "selected" : ""}} value="09">Tháng 09</option>
                <option {{request('month') === "10" ? "selected" : ""}} value="10">Tháng 10</option>
                <option {{request('month') === "11" ? "selected" : ""}} value="11">Tháng 11</option>
                <option {{request('month') === "12" ? "selected" : ""}} value="12">Tháng 12</option>
              </select>
            </div>
            <div class="col-auto px-1">
              <select class="form-select cursor-pointer" id="day" name="day">
                <option value="0">Chọn ngày</option>
                <option {{request('day') === "01" ? "selected" : ""}} value="01">Ngày 01</option>
                <option {{request('day') === "02" ? "selected" : ""}} value="02">Ngày 02</option>
                <option {{request('day') === "03" ? "selected" : ""}} value="03">Ngày 03</option>
                <option {{request('day') === "04" ? "selected" : ""}} value="04">Ngày 04</option>
                <option {{request('day') === "05" ? "selected" : ""}} value="05">Ngày 05</option>
                <option {{request('day') === "06" ? "selected" : ""}} value="06">Ngày 06</option>
                <option {{request('day') === "07" ? "selected" : ""}} value="07">Ngày 07</option>
                <option {{request('day') === "08" ? "selected" : ""}} value="08">Ngày 08</option>
                <option {{request('day') === "09" ? "selected" : ""}} value="09">Ngày 09</option>
                <option {{request('day') === "10" ? "selected" : ""}} value="10">Ngày 10</option>
                <option {{request('day') === "11" ? "selected" : ""}} value="11">Ngày 11</option>
                <option {{request('day') === "12" ? "selected" : ""}} value="12">Ngày 12</option>
                <option {{request('day') === "13" ? "selected" : ""}} value="13">Ngày 13</option>
                <option {{request('day') === "14" ? "selected" : ""}} value="14">Ngày 14</option>
                <option {{request('day') === "15" ? "selected" : ""}} value="15">Ngày 15</option>
                <option {{request('day') === "16" ? "selected" : ""}} value="16">Ngày 16</option>
                <option {{request('day') === "17" ? "selected" : ""}} value="17">Ngày 17</option>
                <option {{request('day') === "18" ? "selected" : ""}} value="18">Ngày 18</option>
                <option {{request('day') === "19" ? "selected" : ""}} value="19">Ngày 19</option>
                <option {{request('day') === "20" ? "selected" : ""}} value="20">Ngày 20</option>
                <option {{request('day') === "21" ? "selected" : ""}} value="21">Ngày 21</option>
                <option {{request('day') === "22" ? "selected" : ""}} value="22">Ngày 22</option>
                <option {{request('day') === "23" ? "selected" : ""}} value="23">Ngày 23</option>
                <option {{request('day') === "24" ? "selected" : ""}} value="24">Ngày 24</option>
                <option {{request('day') === "25" ? "selected" : ""}} value="25">Ngày 25</option>
                <option {{request('day') === "26" ? "selected" : ""}} value="26">Ngày 26</option>
                <option {{request('day') === "27" ? "selected" : ""}} value="27">Ngày 27</option>
                <option {{request('day') === "28" ? "selected" : ""}} value="28">Ngày 28</option>
                <option {{request('day') === "29" ? "selected" : ""}} value="29">Ngày 29</option>
                <option {{request('day') === "30" ? "selected" : ""}} value="30">Ngày 30</option>
                <option {{request('day') === "31" ? "selected" : ""}} value="31">Ngày 31</option>
              </select>
            </div>
            <div class="col-auto ps-1 pe-0">
              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <!--end row-->
        </div>
        <!--end card-header-->
        <div class="card-body pt-0">
          <div id="monthly_income" class="apex-charts"></div>
          <div id="monthly_income2" class="apex-charts"></div>
          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="card shadow-none border mb-3 mb-lg-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col text-center">
                      <span class="fs-18 fw-semibold">Danh thu</span>
                      <h6 class="text-danger mt-2 m-0">
                        {{number_format($revenue, 0, '', '.')}} VNĐ
                        @if($revenue > 0 && $lastRevenue > 0 && $revenue > $lastRevenue)
                          &nbsp;&nbsp;<span class="text-success"><i class="fa-solid fa-arrow-up-wide-short"></i> {{round((($revenue - $lastRevenue) / $lastRevenue) * 100)}}%</span>
                        @elseif($revenue > 0 && $lastRevenue > 0 && $revenue < $lastRevenue)
                          &nbsp;&nbsp;<span class="text-warning"><i class="fa-solid fa-arrow-down-wide-short"></i> {{ltrim(round((($revenue - $lastRevenue) / $lastRevenue) * 100), "-")}}%</span>
                        @endif
                      </h6>
                    </div>
                    <!--end col-->
                  </div>
                  <!-- end row -->
                </div>
                <!--end card-body-->
              </div>
              <!--end card-body-->
            </div>
            <!--end col-->
            <div class="col-md-6 col-lg-3">
              <div class="card shadow-none border mb-3 mb-lg-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col text-center">
                      <span class="fs-18 fw-semibold">Lợi nhuận</span>
                      <h6 class="mt-2 m-0 text-danger">
                        {{number_format($profit, 0, '', '.')}} VNĐ
                        @if($profit > 0 && $lastProfit > 0 && $profit > $lastProfit)
                          &nbsp;&nbsp;<span class="text-success"><i class="fa-solid fa-arrow-up-wide-short"></i> {{round((($profit - $lastProfit) / $lastProfit) * 100, 1)}}%</span>
                        @elseif($profit > 0 && $lastProfit > 0 && $profit < $lastProfit)
                          &nbsp;&nbsp;<span class="text-warning"><i class="fa-solid fa-arrow-down-wide-short"></i> {{ltrim(round((($profit - $lastProfit) / $lastProfit) * 100, 1), "-")}}%</span>
                        @endif
                      </h6>
                    </div>
                    <!--end col-->
                  </div>
                  <!-- end row -->
                </div>
                <!--end card-body-->
              </div>
              <!--end card-body-->
            </div>
            <!--end col-->
            <div class="col-md-6 col-lg-3">
              <div class="card shadow-none border mb-3 mb-lg-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col text-center">
                      <span class="fs-18 fw-semibold">Đơn hàng</span>
                      <h6 class="mt-2 m-0 text-primary">
                        {{$order < 10 && $order > 0 ? "0".$order : $order}} đơn hàng
                        @if($order > 0 &&  $lastOrder > 0 && $order > $lastOrder)
                          &nbsp;&nbsp;<span class="text-success"><i class="fa-solid fa-arrow-up-wide-short"></i> {{round((($order - $lastOrder) / $lastOrder) * 100, 1)}}%</span>
                        @elseif($order > 0 &&  $lastOrder > 0 && $order < $lastOrder)
                          &nbsp;&nbsp;<span class="text-warning"><i class="fa-solid fa-arrow-down-wide-short"></i> {{ltrim(round((($order - $lastOrder) / $lastOrder) * 100, 1), "-")}}%</span>
                        @endif
                      </h6>
                    </div>
                    <!--end col-->
                  </div>
                  <!-- end row -->
                </div>
                <!--end card-body-->
              </div>
              <!--end card-->
            </div>
            <!--end col-->
            <div class="col-md-6 col-lg-3">
              <div class="card shadow-none border mb-3 mb-lg-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col text-center">
                      <span class="fs-18 fw-semibold">Hoàn thành</span>
                      <h6 class="text-purple mt-2 m-0">
                        @php
                            $orderPercent = $order > 0 ? round((($orderSuccess / $order) * 100), 1) : 0;
                            $lastOrderPercent = $lastOrder > 0 ? round((($lastOrderSuccess / $lastOrder) * 100), 1) : 0;
                        @endphp
                        {{ $orderPercent }}%
                        @if($orderPercent > 0 && $lastOrderPercent > 0 && $orderPercent > $lastOrderPercent)
                          &nbsp;&nbsp;<span class="text-success"><i class="fa-solid fa-arrow-up-wide-short"></i> {{round((($orderPercent - $lastOrderPercent) / $lastOrderPercent) * 100, 1)}}%</span>
                        @elseif($orderPercent > 0 && $lastOrderPercent > 0 && $orderPercent < $lastOrderPercent)
                          &nbsp;&nbsp;<span class="text-warning"><i class="fa-solid fa-arrow-down-wide-short"></i> {{ltrim(round((($orderPercent - $lastOrderPercent) / $lastOrderPercent) * 100, 1), "-")}}%</span>
                        @endif
                      </h6>
                    </div>
                    <!--end col-->
                  </div>
                  <!-- end row -->
                </div>
                <!--end card-body-->
              </div>
              <!--end card-body-->
            </div>
            <!--end col-->
          </div>
          <!--end row-->
        </div>
        <!--end card-body-->
      </div>
      <!--end card-->
    </div>
    <!--end col-->
  </div>
  <!--end row-->
  <div class="row justify-content-center">
    <div class="col-md-4 col-lg-4">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col d-flex justify-content-between align-items-center">
              <h4 class="card-title">Top {{request('topSelling') ?? 5}} sản phẩm bán chạy nhất</h4>
              <select name="topSelling" style="font-size: 9px" onchange="submit()">
                <option {{request('topSelling') == 5 ? "selected" : ""}} value="5">Top 5</option>
                <option {{request('topSelling') == 10 ? "selected" : ""}} value="10">Top 10</option>
              </select>
            </div>
            <!--end col-->
          </div>
          <!--end row-->
        </div>
        <!--end card-header-->
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table mb-0">
              <tbody>
                @forelse ($topbestSellingProducts as $topbestSellingProduct)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img
                        src="{{".".Storage::url($topbestSellingProduct->image)}}"
                        height="40"
                        class="me-3 align-self-center rounded"
                        alt="..."
                      />
                      <div class="flex-grow-1 text-truncate">
                        <div class="d-flex align-items-center justify-content-between">
                          <div>
                            <h6 class="m-0 fs-12">{{$topbestSellingProduct->name}}</h6>
                          <a href="{{route('product.show', $topbestSellingProduct->id)}}" class="fs-12 text-primary"
                            >ID: {{$topbestSellingProduct->product_code}}</a
                          >
                          </div>
                        <span class="text-danger fs-12">Đã bán {{$topbestSellingProduct->order_details_sum_quantity}}</span>
                        </div>
                      </div>
                      <!--end media body-->
                    </div>
                  </td>
                </tr>
                @empty
                    <p class="text-danger">Không có sản phẩm nào</p>
                @endforelse
              </tbody>
            </table>
            <!--end table-->
          </div>
          <!--end /div-->
        </div>
        <!--end card-body-->
      </div>
      <!--end card-->
    </div>
    <!--end col-->
    <div class="col-md-4 col-lg-4">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col d-flex justify-content-between align-items-center">
              <h4 class="card-title">Top {{request('topRevenue') ?? 5}} sản phẩm doanh thu cao nhất</h4>
              <select name="topRevenue" style="font-size: 9px" onchange="submit()">
                <option {{request('topRevenue') == 5 ? "selected" : ""}} value="5">Top 5</option>
                <option {{request('topRevenue') == 10 ? "selected" : ""}} value="10">Top 10</option>
              </select>
            </div>
            <!--end col-->
          </div>
          <!--end row-->
        </div>
        <!--end card-header-->
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table mb-0">
              <tbody>
                @forelse ($tophighestRevenueProducts as $tophighestRevenueProduct)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img
                        src="{{".".Storage::url($tophighestRevenueProduct->image)}}"
                        height="40"
                        class="me-3 align-self-center rounded"
                        alt="..."
                      />
                      <div class="flex-grow-1 text-truncate">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h6 class="m-0 fs-12">{{$tophighestRevenueProduct->name}}</h6>
                          <a href="{{route('product.show', $tophighestRevenueProduct->id)}}" class="fs-12 text-primary"
                            >ID: {{$tophighestRevenueProduct->product_code}}</a
                          >
                          </div>
                          <span class="text-danger fs-12">{{number_format($tophighestRevenueProduct->order_details_sum_price, 0, '', '.')}} vnđ</span>
                        </div>
                      </div>
                      <!--end media body-->
                    </div>
                  </td>
                </tr>
                @empty
                    <p class="text-danger">Không có sản phẩm nào</p>
                @endforelse
              </tbody>
            </table>
            <!--end table-->
          </div>
          <!--end /div-->
        </div>
        <!--end card-body-->
      </div>
      <!--end card-->
    </div>
    <!--end col-->
    <div class="col-md-4 col-lg-4">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col d-flex justify-content-between align-items-center">
              <h4 class="card-title">Top {{request('topProfit') ?? 5}} sản phẩm lợi nhuận cao nhất</h4>
              <select name="topProfit" style="font-size: 9px" onchange="submit()">
                <option {{request('topProfit') == 5 ? "selected" : ""}} value="5">Top 5</option>
                <option {{request('topProfit') == 10 ? "selected" : ""}} value="10">Top 10</option>
              </select>
            </div>
            <!--end col-->
          </div>
          <!--end row-->
        </div>
        <!--end card-header-->
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table mb-0">
              <tbody>
                @forelse ($tophighestProfitProducts as $tophighestProfitProduct)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img
                        src="{{".".Storage::url($tophighestProfitProduct->image)}}"
                        height="40"
                        class="me-3 align-self-center rounded"
                        alt="..."
                      />
                      <div class="flex-grow-1 text-truncate">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h6 class="m-0 fs-12">{{$tophighestProfitProduct->name}}</h6>
                          <a href="{{route('product.show', $tophighestProfitProduct->id)}}" class="fs-12 text-primary"
                            >ID: {{$tophighestProfitProduct->product_code}}</a
                          >
                          </div>
                          <span class="text-danger fs-12">{{number_format($tophighestProfitProduct->order_details_sum_price, 0, '', '.')}} vnđ</span>
                        </div>
                      </div>
                      <!--end media body-->
                    </div>
                  </td>
                </tr>
                @empty
                    <p class="text-danger">Không có sản phẩm nào</p>
                @endforelse
              </tbody>
            </table>
            <!--end table-->
          </div>
          <!--end /div-->
        </div>
        <!--end card-body-->
      </div>
      <!--end card-->
    </div>
    <!--end col-->
  </div>
  <!--end row-->
  </form>
</div>
<!-- container -->

{{-- Thêm js --}}
@section('script')
<script>
  var chartTimeUnit = @json($chartTimeUnit);
  var unit = @json($unit);
  var chartRevenue = @json($chartRevenue);
  var chartProfit = @json($chartProfit);
  var revenue = {{$revenue}};
  var profit = {{$profit}};
</script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assets/js/pages/ecommerce-index.init.js"></script>
  <script>
    function submit(){
      document.querySelector('form').submit();
    }
    function updateDays() {
      const yearSelect = document.getElementById('year');
      const monthSelect = document.getElementById('month');
      const daySelect = document.getElementById('day');
      daySelect.innerHTML = '<option value="0">Chọn ngày</option>';
      if (yearSelect.value && monthSelect.value) {
          const year = parseInt(yearSelect.value);
          const month = parseInt(monthSelect.value);
          const daysInMonth = new Date(year, month, 0).getDate();
          for (let day = 1; day <= daysInMonth; day++) {
              daySelect.innerHTML += `<option value="${day < 10 ? 0 : ""}${day}">Ngày ${day < 10 ? 0 : ""}${day}</option>`;
          }
      }
    }
  </script>
@endsection
