<div class="container mt-5">
    <h1 class="text-center mb-4">Thêm Danh Mục</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Tên Danh Mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" value="{{ old('name') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="image" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary me-md-2">Trở Về</a>
                    <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
