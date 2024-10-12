@extends('client.layouts.master')

@section('title')
Tin tức
@endsection

@section('content')
<div class="hs_blog_categories_main_wrapper">
    <div class="container">
        <div class="row" style="display: flex; align-items: stretch;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="hs_blog_left_sidebar_main_wrapper">
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px;">
                            <div class="hs_blog_box1_main_wrapper">
                                <div class="hs_blog_box1_img_wrapper">
                                    @php
                                    $url = $post->img_post;
                                    if (!\Str::contains($url, 'http')) {
                                    $url = Storage::url($url);
                                    }
                                    @endphp
                                    <img src="{{ $url }}" alt="Chưa có ảnh" style="width: 100%; height: 100%; object-fit: cover;" />
                                </div>
                                <div class="hs_blog_box1_cont_main_wrapper">
                                    <div class="hs_blog_cont_heading_wrapper">
                                        <ul>
                                            <li>{{ $post->created_at->format('d/m/Y') }}</li>
                                            <li>by Admin</li>
                                        </ul>
                                        <h2>{{ $post->title }}</h2>
                                        <p>{{ Str::limit($post->description, 150) }}</p>
                                        <h5><a href="{{ route('posts.show', $post->id) }}">Đọc thêm <i class="fa fa-long-arrow-right"></i></a></h5>
                                    </div>
                                </div>
                                {{-- <div class="hs_blog_box1_bottom_cont_main_wrapper">
                                    <div class="hs_blog_box1_bottom_cont_left">
                                        <ul>
                                            <li><i class="fa fa-thumbs-up"></i> &nbsp;&nbsp;<a href="#">1244 Likes</a></li>
                                            <li><i class="fa fa-comments"></i> &nbsp;&nbsp;<a href="#">256 Comments</a></li>
                                            <li><i class="fa fa-tags"></i> &nbsp;&nbsp;<a href="#">Category Name</a></li>
                                        </ul>
                                    </div>
                                    <div class="hs_blog_box1_bottom_cont_right">
                                        <ul>
                                            <li><a href="https://www.facebook.com/dathbta.04"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @endforeach

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pager_wrapper prs_blog_pagi_wrapper">
                                {{ $posts->links('pagination::bootstrap-4') }} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
    .pager_wrapper .pagination {
    display: flex;
    justify-content: center;
    align-items: center; /* Canh giữa các nút theo chiều dọc */
}

.pager_wrapper .pagination li {
    list-style: none;
}

.pager_wrapper .pagination li a,
.pager_wrapper .pagination li span {
    display: flex;
    justify-content: center; /* Canh giữa nội dung theo chiều ngang */
    align-items: center;      /* Canh giữa nội dung theo chiều dọc */
    width: 40px; /* Chiều rộng cố định */
    height: 40px; /* Chiều cao cố định */
    margin: 0 5px;
    text-decoration: none;
    color: #fff;
    background-color: #ff6600; /* Màu cam mặc định */
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.pager_wrapper .pagination li.active span {
    background-color: #0066cc; /* Màu xanh cho trang hiện tại */
}

.pager_wrapper .pagination li:hover a {
    background-color: #ff9900; /* Màu cam đậm hơn khi hover */
}

.pager_wrapper .pagination li.disabled span {
    background-color: #ccc; /* Màu xám cho các nút không bấm được */
}

/* Đảm bảo các nút mũi tên có cùng kích thước */
.pager_wrapper .pagination li a i,
.pager_wrapper .pagination li span i {
    line-height: normal; /* Đặt lại line-height cho biểu tượng */
}

    </style>
@endsection