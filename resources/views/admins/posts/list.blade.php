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
                            <div class="col-auto">
                                <a href="{{ route('post.create') }}"><button type="button" class="btn btn-primary"><i
                                            class="fa-solid fa-plus me-1"></i> Thêm bài viết</button></a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all">
                            <thead class="table-light">
                                <tr>
                                    <th>Bài viết</th>
                                    <th>Thời gian đăng bài</th>
                                    {{-- <th>Bình luận</th> --}}
                                    <th>Lượt xem</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @forelse ($post as $post)
                                <tr>     
                                    <td>
                                        <a href="{{route('post.show', $post->id)}}" class="me-1"><img src="{{".".Storage::url($post->image)}}" alt="" height="40"></a>
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="{{route('post.show', $post->id)}}" class="d-inline-block align-middle mb-0 product-name">{{$post->title}}</a> 
                                        </p>
                                    </td>
                                   
                                    <td>
                                        <span>{{ $post->created_at->format('h:i A | d/m/Y') }}</span>

                                    </td>
                                   
                                    <td>
                                        <span>{{$post->views}}</span>
                                    </td>
                                    
                                    <td class="text-end">                                                       
                                        <a href="{{route('post.edit', $post->id)}}"><i class="las la-pen text-secondary fs-18"></i></a>
                                        <form class="d-inline" action="{{route('post.destroy', $post->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('Bạn có chắc chắn chuyển vào thùng rác không ?')" class="btn-reset"><i class="las la-trash-alt text-secondary fs-18"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-danger">Không có bài viết nào</td>
                                </tr>
                                @endforelse  
                              
                            </tbody>
                        </table>
                        {{-- Phân trang --}}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->

{{-- Thêm js --}}
@section('script')
    {{-- <script>
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

        selectAllHead.addEventListener('change', function() {
            checkedHead(); // Gọi hàm checkedAll để đồng bộ tất cả
        });

        selectAllFoot.addEventListener('change', function() {
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
            if (checkedValues.length > 0) {
                // Gán các giá trị đã checked vào thẻ input hidden
                if (confirm("Bạn có chắc chắn chuyển vào thùng rác không ?")) {
                    selectedValuesInput.value = checkedValues.join(
                        ','); // Ghép các giá trị thành chuỗi, phân tách bằng dấu phẩy
                    myForm.submit();
                } else {
                    actionSelect.value = 0;
                }
            } else {
                alert("Chưa có khách hàng nào được chọn");
                actionSelect.value = 0;
            }
        }
    </script> --}}
@endsection
