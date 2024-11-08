<div class="container-xxl animated fadeInDown">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">{{ $title }}</h4>
                </div><!--end col-->
                <div class="col-auto">
                    <a href="{{ route('slide-show.create') }}"><button type="button" class="btn btn-primary"><i
                                class="fa-solid fa-plus me-1"></i> Thêm slide show</button></a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                @forelse ($slideShows as $slideShow)
                    <div class="col-4">
                        <div id="carouselExampleIndicators{{ $slideShow->id }}" class="carousel slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators{{ $slideShow->id }}"
                                    data-bs-slide-to="0" class="active" aria-current="true"
                                    aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators{{ $slideShow->id }}"
                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators{{ $slideShow->id }}"
                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                @foreach ($slideShow->slideShowGalleries as $slideShowGallery)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ '.' . Storage::url($slideShowGallery->image) }}"
                                            class="d-block w-100" alt="..." />
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators{{ $slideShow->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators{{ $slideShow->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="mt-2">
                            <form class="d-inline" action="{{ route('slide-show.apply', $slideShow->id) }}"
                                method="post">
                                @csrf
                                <button type="submit" {{ $slideShow->active === 'on' ? 'disabled' : '' }}
                                    onclick="return confirm('Bạn có chắc chắn muốn sử dụng không ?')"
                                    class="btn btn-info">{{ $slideShow->active === 'on' ? 'Đang áp dụng' : 'Áp dụng' }}</button>
                            </form>
                            <a href="{{ route('slide-show.edit', $slideShow->id) }}"><button
                                    class="btn btn-warning">Sửa</button></a>
                            <form class="d-inline" action="{{ route('slide-show.destroy', $slideShow->id) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                @if ($slideShow->active === 'on')
                                    <button type="button" onclick="return alert('Bạn không thể xóa vì đang sử dụng !')"
                                        class="btn btn-danger">Xóa</button>
                                @else
                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')"
                                        class="btn btn-danger">Xóa</button>
                                @endif
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-danger">Không có slide show nào</p>
                @endforelse
            </div>
            <!--end row-->
        </div>
    </div>
</div>
