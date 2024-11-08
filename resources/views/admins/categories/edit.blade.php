<div class="container mt-5">
    <h1 class="text-center mb-4">Sửa Danh Mục</h1>
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
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Tên Danh Mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" value="{{ old('name', $category->name) }}">
                </div>
                <div class="form-group mb-4">
                    <label for="image" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <img class="mt-1" id="img" src="{{ asset('/storage/' . $category->image) }}" width="100px" alt="{{ $category->title }}">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary me-md-2">Trở Về</a>
                    <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
