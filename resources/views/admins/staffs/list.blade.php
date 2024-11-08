<div class="container-xxl animated fadeInDown"> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">{{$title}}</h4>                      
                        </div><!--end col-->
                        <div class="col-auto"> 
                            <form id="form_filter" method="GET" action="{{route('staff.index')}}" class="row g-2">
                                <div class="col-auto">
                                    <select name="perPage" class="form-select" onchange="submitForm()">
                                        <option {{ request('perPage') == 5 ? "selected" : ""}} value="5">5 nhân viên</option>
                                        <option {{ request('perPage') == 8 ? "selected" : ""}} value="8">8 nhân viên</option>
                                        <option {{ request('perPage') == 10 ? "selected" : ""}} value="10">10 nhân viên</option>
                                        <option {{ request('perPage') == 12 ? "selected" : ""}} value="12">12 nhân viên</option>
                                        <option {{ request('perPage') == 15 ? "selected" : ""}} value="15">15 nhân viên</option>
                                        {{-- request('perPage'): dữ lại value cũ của perPage --}}
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="orderBy" class="form-select" onchange="submitForm()">
                                        <option {{ request('orderBy') == "lastest" ? "selected" : ""}} value="lastest">Mới nhất</option>
                                        <option {{ request('orderBy') == "oldest" ? "selected" : ""}} value="oldest">Cũ nhất</option>
                                        {{-- request('orderBy'): dữ lại value cũ của orderBy --}}
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="status" class="form-select" onchange="submitForm()">
                                        <option {{ request('status') == 0 ? "selected" : ""}} value="0">Trạng thái</option>
                                        <option {{ request('status') == "active" ? "selected" : ""}} value="active">Hoạt động</option>
                                        <option {{ request('status') == "banned" ? "selected" : ""}} value="banned">Bị cấm</option>
                                        {{-- request('status'): dữ lại value cũ của status --}}
                                    </select>
                                </div>
                                <div class="col-auto d-flex">
                                    <input type="text" id="keyword-input" class="form-control border-end-0" name="keyWord" value="{{request('keyWord')}}" placeholder="Từ khóa..." style="border-top-right-radius: 0; border-bottom-right-radius: 0">
                                    {{-- request('keyWord'): dữ lại value cũ của keyWord --}}
                                    <button class="btn btn-info text-nowrap" style="border-top-left-radius: 0; border-bottom-left-radius: 0" onclick="validateAndSubmit()">Tìm kiếm</button>
                                </div>

                                <div class="col-auto">
                                  <a href="{{route('staff.create')}}"><button type="button" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Thêm nhân viên</button></a>
                                </div><!--end col-->
                            </form>    
                        </div><!--end col-->
                    </div><!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    
                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all">
                            <thead class="table-light">
                              <tr>
                                <th style="width: 16px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="select-all-head">                                                    
                                    </div>
                                </th>
                                <th class="ps-0">ID</th>
                                <th>Avatar</th>
                                <th>Email</th>
                                <th class="text-center">Ngày tham gia</th>
                                <th class="text-center">Vai trò</th>
                                <th class="text-center">Trạng thái</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user) {{-- In danh sách users --}}
                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input select" value="{{$user->id}}">
                                        </div>
                                    </td>
                                    <td class="ps-0"><span class="badge bg-transparent border border-blue text-blue">{{$user->user_code}}</span></td>
                                    <td>
                                        <a href="{{route('staff.show', $user->id)}}">
                                            <img src="{{$user->image ? ".".Storage::url($user->image) : "assets/images/users/avatar-default-staff.png"}}" alt="" class="thumb-md d-inline rounded-circle me-1">
                                        </a>
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="{{route('staff.show', $user->id)}}" style="color: inherit"><span class="font-13 fw-medium">{{$user->name}}</span></a> 
                                        </p>
                                    </td>
                                    <td><a href="#" class="d-inline-block align-middle mb-0 text-body">{{$user->email}}</a></td>
                                    <td class="text-center">{{date('d/m/Y', strtotime($user->created_at))}}</td>
                                    <td class="text-center"><span class="badge bg-blue-subtle text-blue text-capitalize">Nhân Viên</span></td>
                                    <td class="text-center"><span class="badge bg-{{$user->status === "active" ? "success" : "danger"}} text-capitalize">{{$user->status}}</span></td>
                                    {{-- Hiển thị trạng thái và in màu tương ứng --}}
                                    <td class="text-end">                                                       
                                        <a href="{{route('staff.edit', $user->id)}}"><i class="las la-pen text-secondary fs-18"></i></a>
                                        <form class="d-inline" action="{{route('staff.destroy', $user->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        <button type="submit" onclick="return confirm('Bạn có chắc chắn chuyển vào thùng rác không ?')" class="btn-reset"><i class="las la-trash-alt text-secondary fs-18"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="8" class="text-danger">Không có nhân viên nào</td></tr>
                                @endforelse                                                                                   
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th style="width: 16px;">
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="select-all-foot">
                                          <form id="myForm" method="POST" action="{{route('staff.trash')}}">
                                            @csrf
                                           <input type="hidden" id="selectedValues" name="selectedValues">
                                          </form>                                             
                                      </div>
                                  </th>
                                  <th class="ps-0" colspan="2">
                                    <select class="form-select w-auto" id="action-select" onchange="getCheckedValues()">
                                        <option value="0" selected>Hành động</option>
                                        <option value="1">Xóa</option>
                                    </select>
                                  </th>
                                  <th colspan="4"></th>
                                  <th class="text-end"><a href="{{route("staff-trash.index")}}"><button class="btn btn-danger py-1 px-2"><i class="fa fa-trash"></i></button></a></th>
                                </tr>
                              </tfoot>
                        </table>
                        <div class="nav-mt-3">{{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}</div> {{-- Phân trang --}}
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
            // Gán các giá trị đã checked vào thẻ input hidden
            if(confirm("Bạn có chắc chắn chuyển vào thùng rác không ?")){
            selectedValuesInput.value = checkedValues.join(','); // Ghép các giá trị thành chuỗi, phân tách bằng dấu phẩy
            myForm.submit();
            }else{
            actionSelect.value = 0;
            }
        }else{
            alert("Chưa có nhân viên nào được chọn");
            actionSelect.value = 0;
        }
    }
 </script>
@endsection