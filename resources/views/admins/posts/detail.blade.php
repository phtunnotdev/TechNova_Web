<div class="container-xxl animated fadeInDown">
    <div class="row">                        
        <div class="col-md-12 col-lg-8">
            <div class="card">  
                <div class="card-body">
                    <div class="row align-items-center">                                        
                        <div class="col ">
                            <div class="d-flex align-items-center">
                                <div class="position-relative div-product-image">
                                    <img src="{{".".Storage::url($post->image)}}" alt="post" class="img-fluid rounded">
                                </div>
                                <div class="ms-3"> 
                                    <p class="m-0 mb-1 fs-3 fw-bold">{{ $post->title }}</p>
                                    <span class="badge bg-primary-subtle text-primary">{{ date('d/m/Y', strtotime($post->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="text-body mb-1">
                            <span class="text-body fw-semibold">Nội dung:</span>&nbsp;
                            <p class="post1">{!! $post->content ? $post->content : "<p>Sản phẩm chưa có mô tả ngắn</p>" !!}</p>
                        </div>                                                            
                    </div>
                </div>
            </div>                             
        </div> <!--end col--> 

        <div class="col-md-12 col-lg-4">
            <div class="card">                                
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-6"> 
                            <div class="card shadow-none border mb-3 mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center">
                                        <i class="iconoir-thumbs-up fs-24 text-primary me-2"></i>
                                        <div class="flex-grow-1 text-truncate"> 
                                            <p class="text-primary mb-0 fw-semibold fs-13">Đánh giá</p>    
                                            <h3 class="mt-1 mb-0 fs11 fw-bold text-primary">{{ $post->comments_count }}</h3>                                                                                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div> 

                        <div class="col-md-6 col-lg-6"> 
                            <div class="card shadow-none border mb-3 mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center">
                                        <i class="iconoir-eye fs-24 text-info me-2"></i>
                                        <div class="flex-grow-1 text-truncate"> 
                                            <p class="text-info mb-0 fw-semibold fs-13">Lượt xem</p>    
                                            <h3 class="mt-1 mb-0 fs11 fw-bold text-info">{{ $post->views }}</h3>                                                                                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div>                              
                    </div>
                </div>
            </div>
        </div> 

    </div><!--end row-->  


    <div class="row">                        
        <div class="col-md-12 col-lg-12 ">
            <div class="card">  
                <div class="card-body">
                    <div class="product-comments">
                        <div class="group-title">
                            <h2>Bình luận</h2>
                        </div>
        
                        <div class="comments-list">
                            @if ($post->comments->isEmpty())
                                <p>Chưa có bình luận nào cho bài viết này.</p>
                            @else
                                @foreach ($post->comments as $comment)
                                    <div class="comment-item border p-2 mb-2 rounded">
                                        <div class="row">
                                            <div class="col-1">
                                                <img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-user-cartoon-avatar-pattern-flat-avatar-png-image_4492883.jpg" alt="User Avatar" width="60px" height="60px" class="user-avatar rounded-circle">
                                            </div>
                                            <div class="col-11">
                                                <div class="comment-content">
                                                    <h5 class="comment-username mb-1">{{ $comment->name }}</h5>
                                                    <p class="comment-date text-muted">{{ $comment->created_at->format('d/m/Y') }}</p>
                                                    <p class="comment-text">{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>  
                </div>
            </div>  
                                        
        </div> <!--end col--> 
    </div><!--end row-->  
</div><!-- container -->

