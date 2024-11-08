@include('clients.components.breadcrumb')
<div class="blog ptb-45">
    <div class="container">
        <div class="main-blog">
            <div class="row">
                @foreach ($posts as $post)  
                <div class="col-lg-4 col-sm-6">
                    <div class="single-latest-blog">
                        <div class="blog-img">
                            <a href="{{route('client.blog.detail', $post->slug)}}"><img src="{{".".Storage::url($post->image)}}" alt="blog-image"></a>
                        </div>
                        <div class="blog-desc">
                            <h4><a href="single-blog.html">{{$post->title}}</a></h4>
                            <ul class="meta-box d-flex">
                                <li class="meta-date"><span><i class="fa fa-calendar" aria-hidden="true"></i>{{$post->created_at->format('d/m/Y')}}</span></li>
                                <li><i class="fa fa-user" aria-hidden="true"></i><a href="#">{{ $post->user->name ?? 'Người dùng không xác định' }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
            <!-- Row End -->
            <div class="row mt-20">
                <div class="col-sm-12">
                    <ul class="blog-pagination ptb-20">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <!-- End of .blog-pagination -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Container End -->
</div>