@include('clients.components.breadcrumb')
<div class="single-blog ptb-45">
    <div class="container">
        <div class="row">   
            <div class="col-lg-12 order-1 order-lg-2">
                <div class="single-sidebar-desc mb-all-40">
                    <div class="sidebar-img sidebar-banner">
                        <img src="{{".".Storage::url($post->image)}}" alt="single-blog-img">
                    </div>
                    <div class="sidebar-post-content">
                        <h3 class="sidebar-lg-title">{{$post->title}}</h3>
                        <ul class="post-meta d-sm-inline-flex">
                            <li><span>Posted </span> {{$author->name}} </li>
                            <li><span> {{$post->created_at->format('d/m/Y')}}</span></li>
                        </ul>
                    </div>
                    <div class="sidebar-desc mb-50">
                      <p>{!!$post->content!!}</p>
                    </div>

                    <div class="mb-3" style="height: 2px; background-color: #000000; margin: 20px 0;"></div> <!-- Thanh ngăn cách -->
                    <div class="border p-5">
                        <h4 class="mb-3">Bình luận</h4>
                        
                            <form action="{{route('comments.store', $post->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên:</label>
                                    <input type="text" name="name" class="form-control custom-input" placeholder="Nhập tên của bạn" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Nội dung bình luận:</label>
                                    <textarea name="content" class="form-control custom-input" rows="4" placeholder="Nhập bình luận của bạn" required></textarea>
                                </div>
                                <div class="text-end mb-3">
                                    <button type="submit" class="btn btn-comment">Gửi bình luận</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>    
        </div>
    </div>
</div>
