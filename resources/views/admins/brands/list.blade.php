<div class="container-xxl animated fadeInDown">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <a href="{{ route('brand.create') }}"><button type="button"
                                    class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Thêm hãng</button></a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">

                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên hãng</th>
                                    <th>Ảnh</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    <tr>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0">
                                                <span class="font-13 fw-medium">{{ $brand->name }}</span>
                                            </p>
                                        </td>
                                        <td>
                                                <img src="{{".".Storage::url($brand->image)}}"
                                                    alt="" class="thumb-md"> 
                                        </td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($brand->created_at)) }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('brand.edit', $brand->id) }}"><i
                                                    class="las la-pen text-secondary fs-18"></i></a>
                                            <form class="d-inline" action="{{ route('brand.destroy', $brand->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                @if ($brand->products->count() > 0)
                                                <button type="button"
                                                onclick="return alert('Bạn không thể xóa hãng này !')"
                                                class="btn-reset"><i
                                                    class="las la-trash-alt text-secondary fs-18"></i></button>
                                                @else
                                                <button type="submit"
                                                    onclick="return confirm('Bạn có muốn xóa không ?')"
                                                    class="btn-reset"><i
                                                        class="las la-trash-alt text-secondary fs-18"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-danger">Không có hãng nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="nav-mt-3">
                            {{ $brands->appends(request()->query())->links('pagination::bootstrap-5') }}</div>
                        {{-- Phân trang --}}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->
