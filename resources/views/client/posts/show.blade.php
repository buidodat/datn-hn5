@extends('client.layouts.master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
<div class="hs_blog_detail_main_wrapper" style="padding: 50px 0;"> <!-- Thêm khoảng cách -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="hs_blog_detail_cont_main_wrapper" style="background-color: #f9f9f9; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
                        <li style="display: inline-block; margin-right: 15px;"><i class="fa fa-calendar"></i> {{ $post->created_at->format('d/m/Y') }}</li>
                        {{-- <li style="display: inline-block;"><i class="fa fa-user"></i> by Admin</li> --}}
                    </ul>
                    
                    <h2 style="color: #333; font-weight: bold; font-size: 32px; margin-bottom: 20px;">{{ $post->title }}</h2>
                    <p style="font-size: 18px; line-height: 1.6; color: #555;">{{($post->description)}}</p>
                    <div class="hs_blog_detail_img_main_wrapper">
                        @php
                            $url = $post->img_post;
                            if (!\Str::contains($url, 'http')) {
                                $url = Storage::url($url);
                            }
                        @endphp
                        <img src="{{ $url }}" alt="{{ $post->title }}" class="responsive-img" />
                    </div>                    
                    <div class="hs_blog_detail_body" style="margin-top: 30px;">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        .hs_blog_detail_main_wrapper {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        /* Cách xa header và footer */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hs_blog_detail_img_main_wrapper img {
            width: 600px; /* Đặt chiều rộng cố định */
            height: 400px; /* Đặt chiều cao cố định */
            object-fit: cover; /* Đảm bảo ảnh không bị biến dạng, giữ nguyên tỷ lệ */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hs_blog_detail_img_main_wrapper {
            text-align: left;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        /* Cải thiện kiểu dáng nội dung */
        .hs_blog_detail_cont_main_wrapper {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Định dạng typography */
        .hs_blog_detail_body {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
            margin-top: 20px;
        }

        .hs_blog_detail_body p {
            margin-bottom: 15px;
        }

        .hs_blog_detail_body h3 {
            font-size: 24px;
            color: #ff6600;
            margin-top: 30px;
            margin-bottom: 15px;
        }
    </style>
@endsection
