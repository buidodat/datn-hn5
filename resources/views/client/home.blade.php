@extends('client.layouts.master')

@section('title')
    Trang Chủ
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/showtime.css') }}" />
@endsection

@section('content')
    @include('client.layouts.slideshow')


    <div class="prs_upcom_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>DANH SÁCH PHIM</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_upcome_tabs_wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"> <a href="#best" aria-controls="best" role="tab"
                                    data-toggle="tab">Phim sắp chiếu</a>
                            </li>
                            <li role="presentation" class="active"><a href="#hot" aria-controls="hot" role="tab"
                                    data-toggle="tab">Phim đang chiếu</a>
                            </li>
                            <li role="presentation"><a href="#trand" aria-controls="trand" role="tab"
                                    data-toggle="tab">Suất chiếu đặc biệt</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    {{-- Phim sắp chiếu --}}
                    <div role="tabpanel" class="tab-pane fade" id="best">
                        <div class="tab-pane-content-movie-list">
                            <div class="item">
                                <div class="row" id="movie-list1">
                                    @foreach ($moviesUpcoming as $movie)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    @if ($movie->is_hot == '1')
                                                        <img class="is_hot" src="{{ asset('theme/client/images/hot.png') }}"
                                                            alt="">
                                                    @endif
                                                    @php
                                                        $imageTag = App\Models\Movie::getImageTagRating($movie->rating);
                                                    @endphp
                                                    @if ($imageTag)
                                                        <img class="tag-rating" src="{{ $imageTag }}" alt="">
                                                    @endif

                                                    @php
                                                        $url = $movie->img_thumbnail;

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }

                                                    @endphp

                                                    <div class='img_thumbnail_movie'>
                                                        <img src="{{ $url }}" alt="movie_img" />
                                                    </div>

                                                </div>


                                                <div class="content-movie">
                                                    <h3 class="movie-name-home">
                                                        <a
                                                            href="movies/{{ $movie->slug }}">{{ Str::limit($movie->name, 20) }}</a>
                                                    </h3>
                                                    <p><span class='text-bold'>Thể loại:</span> {{ $movie->category }} </p>
                                                    <p><span class='text-bold'>Thời lượng:</span> {{ $movie->duration }}
                                                        phút </p>
                                                    <p><span class='text-bold'>Ngày khởi chiếu:</span>
                                                        {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}
                                                    </p>



                                                </div>


                                                @php
                                                    // Kiểm tra có suất chiếu trong 7 ngày tới tại cinema_id
                                                    $hasShowtimeInNextWeek = $movie
                                                        ->showtimes()
                                                        ->where('cinema_id', session('cinema_id')) // Kiểm tra theo cinema_id
                                                        ->whereBetween('start_time', [$currentNow, $endDate])
                                                        ->exists();
                                                @endphp

                                                <div class='buy-ticket-movie'>
                                                    @if ($hasShowtimeInNextWeek)
                                                        <button onclick="openModalMovieScrening({{ $movie->id }})"
                                                            class="buy-ticket-btn">MUA VÉ</button>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        @if ($moviesUpcoming->total() > 8)
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                        <ul>
                                            <li>
                                                <button class="button button--tamaya prs_upcom_main_btn text-white"
                                                    data-text="Xem thêm" id="load-more1" data-page="2">Xem thêm</button>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- Phim đang chiếu --}}
                    <div role="tabpanel" class="tab-pane fade  in active" id="hot">
                        <div class="tab-pane-content-movie-list">
                            <div class="item">
                                <div class="row" id="movie-list2">
                                    {{-- @dd($moviesShowing) --}}
                                    @foreach ($moviesShowing as $movie)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    @if ($movie->is_hot == '1')
                                                        <img class="is_hot"
                                                            src="{{ asset('theme/client/images/hot.png') }}"
                                                            alt="">
                                                    @endif
                                                    @php
                                                        $imageTag = App\Models\Movie::getImageTagRating($movie->rating);
                                                    @endphp
                                                    @if ($imageTag)
                                                        <img class="tag-rating" src="{{ $imageTag }}" alt="">
                                                    @endif
                                                    @php
                                                        $url = $movie->img_thumbnail;

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }

                                                    @endphp

                                                    <div class='img_thumbnail_movie'>
                                                        <img src="{{ $url }}" alt="movie_img" />
                                                    </div>

                                                </div>


                                                <div class="content-movie">
                                                    <h3 class="movie-name-home">
                                                        <a
                                                            href="movies/{{ $movie->slug }}">{{ Str::limit($movie->name, 20) }}</a>
                                                    </h3>
                                                    <p><span class='text-bold'>Thể loại:</span> {{ $movie->category }}</p>
                                                    <p><span class='text-bold'>Thời lượng:</span> {{ $movie->duration }}
                                                        phút </p>

                                                </div>


                                                @php
                                                    // Kiểm tra có suất chiếu trong 7 ngày tới tại cinema_id
                                                    $hasShowtimeInNextWeek = $movie
                                                        ->showtimes()
                                                        ->where('cinema_id', session('cinema_id')) // Kiểm tra theo cinema_id
                                                        ->whereBetween('start_time', [$currentNow, $endDate])
                                                        ->exists();
                                                @endphp

                                                <div class='buy-ticket-movie'>
                                                    @if ($hasShowtimeInNextWeek)
                                                        <button onclick="openModalMovieScrening({{ $movie->id }})"
                                                            class="buy-ticket-btn">MUA VÉ</button>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        @if ($moviesShowing->total() > 8)
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                        <ul>
                                            <li>
                                                <button class="button button--tamaya prs_upcom_main_btn text-white"
                                                    data-text="Xem thêm" id="load-more2" data-page="2">Xem thêm</button>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- Suất chiếu đặc biệt --}}
                    <div role="tabpanel" class="tab-pane fade" id="trand">
                        <div class="tab-pane-content-movie-list">
                            <div class="item">
                                <div class="row" id="movie-list3">
                                    @foreach ($moviesSpecial as $movie)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    @if ($movie->is_hot == '1')
                                                        <img class="is_hot"
                                                            src="{{ asset('theme/client/images/hot.png') }}"
                                                            alt="">
                                                    @endif
                                                    @php
                                                        $imageTag = App\Models\Movie::getImageTagRating($movie->rating);
                                                    @endphp
                                                    @if ($imageTag)
                                                        <img class="tag-rating" src="{{ $imageTag }}"
                                                            alt="">
                                                    @endif

                                                    @php
                                                        $url = $movie->img_thumbnail;

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }

                                                    @endphp

                                                    <div class='img_thumbnail_movie'>
                                                        <img src="{{ $url }}" alt="movie_img" />
                                                    </div>

                                                </div>


                                                <div class="content-movie">
                                                    <h3 class="movie-name-home">
                                                        <a
                                                            href="movies/{{ $movie->slug }}">{{ Str::limit($movie->name, 20) }}</a>
                                                    </h3>
                                                    <p><span class='text-bold'>Thể loại:</span> {{ $movie->category }}
                                                    </p>
                                                    <p><span class='text-bold'>Thời lượng:</span> {{ $movie->duration }}
                                                        phút </p>
                                                </div>


                                                @php
                                                    // Kiểm tra có suất chiếu trong 7 ngày tới tại cinema_id
                                                    $hasShowtimeInNextWeek = $movie
                                                        ->showtimes()
                                                        ->where('cinema_id', session('cinema_id')) // Kiểm tra theo cinema_id
                                                        ->whereBetween('start_time', [$currentNow, $endDate])
                                                        ->exists();
                                                @endphp

                                                <div class='buy-ticket-movie'>
                                                    @if ($hasShowtimeInNextWeek)
                                                        <button onclick="openModalMovieScrening({{ $movie->id }})"
                                                            class="buy-ticket-btn">MUA VÉ</button>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        @if ($moviesSpecial->total() > 8)
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                        <ul>
                                            <li>
                                                <button class="button button--tamaya prs_upcom_main_btn text-white"
                                                    data-text="Xem thêm" id="load-more1" data-page="2">Xem thêm</button>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="prs_feature_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>Tin tức & ưu đãi</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_feature_slider_wrapper" id="post-content">
                        <div class="owl-carousel owl-theme show-post">
                            @foreach ($posts as $postItem)
                                <div class="item prs_feature_slider_item_wrapper">
                                    <div class="prs_feature_img_box_wrapper">
                                        <div class="prs_feature_img"
                                            style="position: relative; overflow: hidden; width: 100%; height: 200px;">
                                            @php
                                                $url = $postItem->img_post;

                                                if (!\Str::contains($url, 'http')) {
                                                    $url = Storage::url($url);
                                                }
                                            @endphp
                                            <img src="{{ $url }}" alt="Chưa có ảnh"
                                                style="width: 100%; height: 100%; object-fit: cover;" />
                                            <div class="prs_ft_btn_wrapper">
                                                <ul>
                                                    <li><a href="{{ route('posts.show', $postItem->slug) }}">Xem chi
                                                            tiết</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="prs_feature_img_cont">
                                            <h2>{!! Str::limit($postItem->title, 30) !!}</h2>
                                            <br>
                                            <div class="prs_ft_small_cont_center">
                                                {!! Str::limit($postItem->description, 70) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="prs_vp_main_section_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="prs_heading_section_wrapper">
                            <h2>Video & photos</h2>
                        </div>
                    </div>
                    <div class="prs_vp_main_slider_wrapper">
                        <div class="prs_vp_left_slidebar_wrapper">
                            <div class="wrap-album-slider">
                                <ul class="prs_vp_left_slider">
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp1.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp1.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp2.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp2.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp3.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp3.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp4.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp4.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp5.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp5.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp6.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp6.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="prs_vp_center_slidebar_wrapper">
                            <div class="prs_vp_center_slider">
                                <div class="owl-carousel owl-theme">
                                    <div class="item">
                                        <div class="prs_vp_center_slider_img_wrapper">
                                            <img src="{{ asset('theme/client/images/content/vp7.jpg') }}" alt="vp_img">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="prs_vp_center_slider_img_wrapper">
                                            <img src="{{ asset('theme/client/images/content/vp7.jpg') }}" alt="vp_img">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="prs_vp_center_slider_img_wrapper">
                                            <img src="{{ asset('theme/client/images/content/vp7.jpg') }}" alt="vp_img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="prs_vp_right_slidebar_wrapper">
                            <div class="wrap-album-slider">
                                <ul class="prs_vp_right_slider">
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp6.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp6.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp5.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp5.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp4.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp4.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp3.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp3.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp2.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp2.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                    <li class="album-slider__item prs_vp_hover_overlay">
                                        <figure class="album">
                                            <div class="prs_vp_img_overlay">
                                                <img src="{{ asset('theme/client/images/content/vp1.jpg') }}" alt="vp_img">
                                                <a href="{{ asset('theme/client/images/content/vp1.jpg') }}"
                                                    class="venobox info" data-title="PORTFOLIO TITTLE" data-gall="gall12"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </figure>
                                        <!-- End album -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="prs_vp_bottom_banner_wrapper">
                            <img src="{{ asset('theme/client/images/content/vp8.jpg') }}" alt="banner">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}



    @include('client.modal-movie-screning')
@endsection

@section('scripts')
    <script src="{{ asset('theme/client/js/showtime.js') }}"></script>
@endsection

@section('style-libs')
    {{-- <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Ajax load xem thêm 3 tab
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('load-more2').addEventListener('click', function() {
                const button = this;
                const page = button.getAttribute('data-page');

                fetch(`/movies2?page=${page}`, {
                        method: 'GET',

                    })
                    .then(response => response.text()) // Đảm bảo nhận về dữ liệu dạng text (HTML)
                    .then(data => {
                        const movieList2 = document.getElementById('movie-list2');
                        // console.log(data);

                        if (data.trim().length > 0) {
                            movieList2.innerHTML += data;

                        } else {
                            // Nếu không có phim để thêm, ẩn nút "Xem thêm"
                            button.style.display = 'none';
                        }

                        button.setAttribute('data-page', parseInt(page) + 1);
                    })
                    .catch(error => console.error('Error:', error));
            });

        });


        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('load-more1').addEventListener('click', function() {
                const button = this;
                const page = button.getAttribute('data-page');

                fetch(`/movies1?page=${page}`, {
                        method: 'GET',

                    })
                    .then(response => response.text()) // Đảm bảo nhận về dữ liệu dạng text (HTML)
                    .then(data => {
                        const movieList1 = document.getElementById('movie-list1');
                        // console.log(data);

                        if (data.trim().length > 0) {
                            movieList1.innerHTML += data;

                        } else {
                            // Nếu không có phim để thêm, ẩn nút "Xem thêm"
                            button.style.display = 'none';
                        }

                        button.setAttribute('data-page', parseInt(page) + 1);
                    })
                    .catch(error => console.error('Error:', error));

            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('load-more3').addEventListener('click', function() {
                // console.log('lcik odasjkf');
                const button = this;
                const page = button.getAttribute('data-page');


                fetch(`/movies3?page=${page}`, {
                        method: 'GET',

                    })
                    .then(response => response.text()) // Đảm bảo nhận về dữ liệu dạng text (HTML)
                    .then(data => {
                        const movieList3 = document.getElementById('movie-list3');
                        console.log(data);

                        if (data.trim().length > 0) {
                            movieList3.innerHTML += data;

                        } else {
                            // Nếu không có phim để thêm, ẩn nút "Xem thêm"
                            button.style.display = 'none';
                        }

                        button.setAttribute('data-page', parseInt(page) + 1);
                    })
                    .catch(error => console.error('Error:', error));
            })
        });
    </script>
@endsection
