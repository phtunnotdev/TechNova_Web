<div class="container-xxl animated fadeInDown">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">{{$title}}</h4>                      
                        </div><!--end col-->
                    </div>  <!--end row-->                                  
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form action="{{route('voucher.update', $voucher->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Mã voucher</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$voucher->voucher_code}}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">% giảm giá</label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("percent") ? "is-invalid" : ""}}" name="percent" value="{{old('percent', $voucher->percent)}}" type="number" placeholder="Nhập vào % giảm giá">
                                        @if ($errors->has("percent"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("percent")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">ĐH tối thiểu</label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("minPrice") ? "is-invalid" : ""}}" name="minPrice" value="{{old('minPrice', $voucher->min_price)}}" type="number" placeholder="Nhập vào giá tối thiểu">
                                        @if ($errors->has("minPrice"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("minPrice")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">ĐH tối đa <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("maxPrice") ? "is-invalid" : ""}}" name="maxPrice" value="{{old('maxPrice', $voucher->max_price)}}" type="number" placeholder="Nhập vào giá tối đa">
                                        @if ($errors->has("maxPrice"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("maxPrice")}}</p>
                                        @endif
                                    </div>
                                </div>  
                            </div><!--end col-->
                            <div class="col-lg-6">    
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Bắt đầu <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("startDate") ? "is-invalid" : ""}}" name="startDate" value="{{old('startDate', $voucher->start_date)}}" min="{{ date('Y-m-d') }}" type="date">
                                        @if ($errors->has("startDate"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("startDate")}}</p>
                                        @endif
                                    </div>
                                </div>                                     
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Kết thúc <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("endDate") ? "is-invalid" : ""}}" name="endDate" min="{{ date('Y-m-d') }}" value="{{old('endDate', $voucher->end_date)}}" type="date">
                                        @if ($errors->has("endDate"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("endDate")}}</p>
                                        @endif
                                    </div>
                                </div>       
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Số lượng <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control {{$errors->has("quantity") ? "is-invalid" : ""}}" name="quantity" value="{{old('quantity', $voucher->quantity)}}" type="number" placeholder="0">
                                        @if ($errors->has("quantity"))
                                        <p class="text-danger mt-1 mb-0">{{$errors->first("quantity")}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Khách hàng</label>
                                    <div class="col-sm-10">
                                        <select name="users[]" class="form-select" multiple>
                                            @foreach ($users as $user)
                                            <option class="text-primary" {{ in_array($user->id, $userIds) ? 'selected' : '' }} value="{{$user->id}}">{{$user->name}} ({{$user->user_code}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end mb-3">
                                    <button type="reset" class="btn btn-danger mr1">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </form>
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col-->                                                       
    </div><!--end row-->
</div>