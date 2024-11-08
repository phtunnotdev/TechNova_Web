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
                            <a href="{{ route('voucher.create') }}"><button type="button"
                                    class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Thêm mã giảm giá</button></a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">

                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã giảm giá</th>
                                    <th>Giảm giá</th>
                                    <th>Giá tối thiểu</th>
                                    <th>Giá tối đa</th>
                                    <th class="text-center">Ngày bắt đầu</th>
                                    <th class="text-center">Ngày kết thúc</th>
                                    <th>Số lượng</th>
                                    <th>Đã sử dụng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vouchers as $voucher)
                                    <tr>
                                        <td><span
                                                class="badge bg-transparent border border-primary text-primary">{{$voucher->voucher_code}}</span>
                                        </td>
                                        <td class="text-success">{{$voucher->percent}}%</td>
                                        <td class="text-danger">{{$voucher->min_price ? number_format($voucher->min_price, 0, '', '.') . " vnđ" : "Không có"}}</td>
                                        <td class="text-danger">{{number_format($voucher->max_price, 0, '', '.') . " vnđ"}}</td>
                                        <td class="text-dark text-center">{{ date('d/m/Y', strtotime($voucher->start_date)) }}</td>
                                        <td class="text-dark text-center">{{ date('d/m/Y', strtotime($voucher->end_date)) }}</td>
                                        <td class="text-danger">{{$voucher->quantity}}</td>
                                        <td class="text-purple">{{$voucher->used_quantity}}</td>
                                        <td class="text-end">
                                            <a href="{{route('voucher.edit', $voucher->id)}}"><i
                                                    class="las la-pen text-secondary fs-18"></i></a>
                                            <form class="d-inline" action="{{route('voucher.destroy', $voucher->id)}}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('Bạn có chắc chắn chuyển xóa không ?')"
                                                    class="btn-reset"><i
                                                        class="las la-trash-alt text-secondary fs-18"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-danger">Không có mã giảm giá nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- <div class="nav-mt-3"> --}}
                            {{-- {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}</div> --}}
                        {{-- Phân trang --}}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->