@extends('client.layouts.master')

@section('title')
    Tin tức
@endsection

@section('content')
<div class="hs_blog_categories_main_wrapper">
    <div class="container">
        <div class="row">
            <!-- Lặp qua 6 bài viết -->
            @foreach($posts as $post)
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 30px;">
                <div class="hs_blog_box1_main_wrapper">
                    <div class="hs_blog_box1_img_wrapper">
                        @php
                        $url = $post->img_post;
                        if (!\Str::contains($url, 'http')) {
                            $url = Storage::url($url);
                        }
                        @endphp
                        <img src="{{ $url }}" alt="Chưa có ảnh" />
                    </div>
                    <div class="hs_blog_box1_cont_main_wrapper">
                        <div class="hs_blog_cont_heading_wrapper">
                            <ul>
                                <li>{{ $post->created_at->format('d/m/Y') }}</li>
                            </ul>
                            <h2>{{ $post->title }}</h2>
                            <p>{{ Str::limit($post->description, 100) }}</p>
                            <h5><a href="{{ route('posts.show', $post->slug) }}">Đọc thêm <i class="fa fa-long-arrow-right"></i></a></h5> <!-- Sử dụng slug -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Phân trang -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="pager_wrapper prs_blog_pagi_wrapper">
                    {{ $posts->links('pagination::bootstrap-4') }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
    .hs_blog_box1_main_wrapper {
        background-color: #F6F6F6;
        padding: 20px;
        border-radius: 10px;
        height: 450px; 
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hs_blog_box1_img_wrapper {
        width: 100%;
        height: 250px;
        overflow: hidden;
    }

    .hs_blog_box1_img_wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .hs_blog_box1_cont_main_wrapper {
        padding-top: 15px;
    }

    .hs_blog_cont_heading_wrapper ul {
        list-style: none;
        padding: 0;
        margin-bottom: 10px;
        color: #ff6600;
    }

    .hs_blog_cont_heading_wrapper h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .hs_blog_cont_heading_wrapper p {
        color: #666;
    }

    .pager_wrapper .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pager_wrapper .pagination li {
        list-style: none;
    }

    .pager_wrapper .pagination li a,
    .pager_wrapper .pagination li span {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        margin: 0 5px;
        text-decoration: none;
        color: #fff;
        background-color: #ff6600;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .pager_wrapper .pagination li.active span {
        background-color: #0066cc;
    }

    .pager_wrapper .pagination li:hover a {
        background-color: #ff9900;
    }

    .pager_wrapper .pagination li.disabled span {
        background-color: #ccc;
    }
    </style>
@endsection
