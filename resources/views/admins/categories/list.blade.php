<div class="container mt-5">
    <h1>Danh Sách Danh Mục</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Thêm Danh Mục</a>
    
    <table class="table table-bordered table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>Hình Ảnh</th>
                <th>Tên Danh Mục</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @if ($categories->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">Không có danh mục nào để hiển thị.</td>
                </tr>
            @else
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            @if ($category->products->count() > 0)
                            <button type="button" class="btn btn-danger" onclick="return alert('Bạn không thể xóa danh mục này !')">Xóa</button>
                            @else
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa danh mục này không?')">Xóa</button>
                            @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{$categories->links()}}
</div>
