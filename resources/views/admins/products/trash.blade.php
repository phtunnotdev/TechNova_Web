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
                            <form id="form_filter" method="GET" action="{{ route('product.index') }}" class="row g-2">
                                <div class="col-auto">
                                    <select name="perPage" class="form-select" onchange="submitForm()">
                                        <option {{ request('perPage') == 8 ? 'selected' : '' }} value="8">8 sản phẩm</option>
                                        <option {{ request('perPage') == 10 ? 'selected' : '' }} value="10">10 sản phẩm</option>
                                        <option {{ request('perPage') == 12 ? 'selected' : '' }} value="12">12 sản phẩm</option>
                                        <option {{ request('perPage') == 15 ? 'selected' : '' }} value="15">15 sản phẩm</option>
                                        <option {{ request('perPage') == 18 ? 'selected' : '' }} value="18">18 sản phẩm</option>
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
                                <div class="col-auto">
                                    <select name="category" class="form-select" onchange="submitForm()">
                                        <option {{ request('category') == 0 ? 'selected' : '' }} value="0">Danh Mục
                                        </option>
                                        <option {{ request('category') == 'active' ? 'selected' : '' }} value="active">
                                            Hoạt động</option>
                                        <option {{ request('category') == 'banned' ? 'selected' : '' }} value="banned">Bị
                                            cấm</option>
                                        {{-- request('category'): dữ lại value cũ của category --}}
                                    </select>
                                </div>
                                <div class="col-auto d-flex">
                                    <input type="text" id="keyword-input" class="form-control border-end-0"
                                        name="keyWord" value="{{ request('keyWord') }}" placeholder="Từ khóa..."
                                        style="border-top-right-radius: 0; border-bottom-right-radius: 0">
                                    {{-- request('keyWord'): dữ lại value cũ của keyWord --}}
                                    <button class="btn btn-info text-nowrap"
                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0"
                                        onclick="validateAndSubmit()">Tìm kiếm</button>
                                </div>

                                <div class="col-auto">
                                    <a href="{{ route('product.create') }}"><button type="button"
                                            class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Thêm sản phẩm</button></a>
                                </div><!--end col-->
                            </form>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">

                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all" id="datatable_1">
                            <thead class="table-light">
                              <tr>
                                <th style="width: 16px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="select-all-head">
                                    </div>
                                </th>
                                <th class="ps-0">ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá bán</th>
                                <th>Số lượng</th>
                                <th>Danh mục</th>
                                <th>Thời gian xóa</th>
                                <th>Trạng thái</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input select" value="{{$product->id}}">
                                        </div>
                                    </td>
                                    <td class="ps-0"><span
                                        class="badge bg-transparent border border-primary text-primary">{{$product->product_code}}</span></td>
                                    <td>
                                        <a href="{{route('product.show', $product->id)}}" class="me-1"><img src="{{".".Storage::url($product->image)}}" alt="" height="40"></a>
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="{{route('product.show', $product->id)}}" class="d-inline-block align-middle mb-0 product-name">{{$product->name}}</a> 
                                        </p>
                                    </td>
                                    <td class="text-danger">{{number_format($product->product_variants_min_price, 0, '', '.')}} vnđ - {{number_format($product->product_variants_max_price, 0, '', '.')}} vnđ</td>
                                    <td>{{$product->product_variants_sum_quantity}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td class="text-danger">
                                        <span>{{date('H:i:s d/m/Y', strtotime($product->deleted_at))}}</span>
                                    </td>
                                    <td><span class="badge bg-{{$product->status==='active' ? 'success' : 'danger'}}-subtle text-{{$product->status==='active' ? 'success' : 'danger'}} text-capitalize"><i class="fas fa-{{$product->status === 'active' ? 'check' : 'xmark'}} me-1"></i> {{$product->status}}</span></td>
                                    <td class="text-end">                                                       
                                        <form class="d-inline" action="{{route('product-trash.update', $product->id)}}" method="POST">
                                            @csrf
                                            @method("put")
                                            <button type="submit" onclick="return confirm('Bạn có chắc chắn khôi phục không ?')" class="btn-reset"><i class="las la-window-restore text-secondary fs-18"></i></button>
                                          </form>                                                       
                                          <form class="d-inline" action="{{route('product-trash.destroy', $product->id)}}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn không ?')" class="btn-reset"><i class="las la-trash-alt text-secondary fs-18"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-danger">Không có sản phẩm nào</td>
                                </tr>
                                @endforelse                                                                           
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="select-all-foot">
                                            <form id="myForm" method="POST" action="">
                                              @csrf
                                             <input type="hidden" id="selectedValues" name="selectedValues">
                                            </form>                                                
                                        </div>
                                    </th>
                                    <th class="ps-0" colspan="2">
                                      <select class="form-select w-auto" id="action-select" onchange="getCheckedValues()">
                                          <option value="0" selected>Hành động</option>
                                          <option value="1">Khôi phục</option>
                                          <option value="2">Xóa vĩnh viễn</option>
                                      </select>
                                    </th>
                                    <th colspan="5"></th>
                                  </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->

{{-- Thêm js --}}
@section('script')
<script>
    function submitForm() {
      document.getElementById('form_filter').submit();
    }

    function validateAndSubmit() {
            var keyword = document.getElementById('keyword-input').value;
            if (keyword.trim() === "") {
                alert("Please enter keyword before searching");
                return false;
            }
            document.getElementById('form_filter').submit();
    }

    //Tạo biến
    var selectAllHead = document.getElementById("select-all-head");   
    var selectAllFoot = document.getElementById("select-all-foot");
    var selects = document.getElementsByClassName("select")
    var selectsArray = Array.from(selects);
    var selectedValuesInput = document.getElementById('selectedValues');
    var actionSelect = document.getElementById('action-select');
    var myForm = document.getElementById('myForm');

    function checkedHead() {
        if (selectAllHead.checked) {
            selectAllFoot.checked = true;
            // Nếu 'selectAllHead' được checked, chọn tất cả các checkbox
            selectsArray.forEach(element => {
                element.checked = true;
            });
        } else {
            selectAllFoot.checked = false;
            // Nếu không, bỏ chọn tất cả các checkbox
            selectsArray.forEach(element => {
                element.checked = false;
            });
        }
    }

    function checkedFoot() {
        if (selectAllFoot.checked) {
            selectAllHead.checked = true;
            // Nếu 'selectAllFoot' được checked, chọn tất cả các checkbox
            selectsArray.forEach(element => {
                element.checked = true;
            });
        } else {
            selectAllHead.checked = false;
            // Nếu không, bỏ chọn tất cả các checkbox
            selectsArray.forEach(element => {
                element.checked = false;
            });
        }
    }

    selectAllHead.addEventListener('change', function () {
        checkedHead(); // Gọi hàm checkedAll để đồng bộ tất cả
    });

    selectAllFoot.addEventListener('change', function () {
        checkedFoot(); // Gọi hàm checkedAll để đồng bộ tất cả
    });

    // Hàm lấy tất cả các giá trị của checkbox đã checked
    function getCheckedValues() {        
        let checkedValues = [];

        selectsArray.forEach(checkbox => {
            if (checkbox.checked) {
                checkedValues.push(checkbox.value); // Lưu value của checkbox đã checked
            }
        });

        if(checkedValues.length > 0){
            if(actionSelect.value == 1){
               var type = "<?php echo route('product.restore')?>";
               var mess = "khôi phục";
            }else{
               var type = "<?php echo route('product.delete')?>";
               var mess = "xóa vĩnh viễn";
            }
            if(confirm("Bạn có chắn chắn "+ mess +" không ?")){
            selectedValuesInput.value = checkedValues.join(','); // Ghép các giá trị thành chuỗi, phân tách bằng dấu phẩy
            myForm.action = type;
            myForm.submit();
            }else{
            actionSelect.value = 0;
            }
        }else{
            alert("Chưa có sản phẩm nào được chọn");
            actionSelect.value = 0;
        }
    }
 </script>
@endsection