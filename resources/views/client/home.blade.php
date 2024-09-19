@extends('client.layouts.master')

@section('title')
    Trang Chủ
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
                                                        $url = $movie->img_thumbnail;

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }

                                                    @endphp

                                                    <img src="{{ $url }}" alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a id="buy-ticket-btn">Mua vé</a>
                                                            </li>
                                                            <li><a href="movie/{{ $movie->slug }}">Xem chi tiết</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2 class="movie-name-home"><a
                                                                href="movie/{{ $movie->slug }}">{{ $movie->name }}</a>
                                                        </h2>
                                                        <p>Thể loại: {{ $movie->category }}</p>
                                                        <p>Thời lượng: {{ $movie->duration }} phút </p>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="pagination-wrapper">
                                        {{ $moviesUpcoming->links() }}
                                    </div> --}}
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
                                                        <img class="is_hot" src="{{ asset('theme/client/images/hot.png') }}"
                                                            alt="">
                                                    @endif

                                                    @php
                                                        $url = $movie->img_thumbnail;

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }

                                                    @endphp

                                                    <img src="{{ $url }}" alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a id="buy-ticket-btn">Mua vé</a>
                                                            </li>
                                                            <li><a href="movie/{{ $movie->slug }}">Xem chi tiết</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2 class="movie-name-home"><a
                                                                href="movie/{{ $movie->slug }}">{{ $movie->name }}</a>
                                                        </h2>
                                                        <p>Thể loại: {{ $movie->category }}</p>
                                                        <p>Thời lượng: {{ $movie->duration }} phút </p>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                {{-- <div class="pagination-wrapper">
                                        {{ $moviesShowing->links() }}
                                    </div> --}}

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
                                                        $url = $movie->img_thumbnail;

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }

                                                    @endphp

                                                    <img src="{{ $url }}" alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a id="buy-ticket-btn">Mua vé</a>
                                                            </li>
                                                            <li><a href="movie/{{ $movie->slug }}">Xem chi tiết</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2 class="movie-name-home"><a
                                                                href="movie/{{ $movie->slug }}">{{ $movie->name }}</a>
                                                        </h2>
                                                        <p>Thể loại: {{ $movie->category }}</p>
                                                        <p>Thời lượng: {{ $movie->duration }} phút </p>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                {{-- <div class="pagination-wrapper">
                                        {{ $moviesSpecial->links() }}
                                    </div> --}}
                            </div>
                        </div>
                        @if ($moviesSpecial->total() > 8)
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                        <ul>
                                            <li>
                                                <button class="button button--tamaya prs_upcom_main_btn text-white"
                                                    data-text="Xem thêm" id="load-more3" data-page="2">Xem thêm</button>

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

    <!-- prs letest news Start	-->
    <div class="prs_ln_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>LAtest News</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="prs_ln_left_img_wrapper">
                        <div class="prs_in_left_img_overlay"></div>
                        <div class="prs_webseri_video_sec_icon_wrapper ">
                            <ul>
                                <li><a class="test-popup-link button" rel='external'
                                        href='https://www.youtube.com/embed/ryzOXAO0Ss0' title='title'><i
                                            class="flaticon-play-button"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="prs_prs_webseri_video_sec_icon_cont_wrapper">
                            <p>28 Feb 2018</p>
                            <h2>The News of theater</h2>
                            <ul>
                                <li><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<a href="#">120 Like</a>
                                </li>
                                <li><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<a href="#">52 Comments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="prs_ln_right_main_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_ln_right_first_box_wrapper">
                                    <div class="prs_in_right_box_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/nl2.jpg') }}" alt="news_img" />
                                    </div>
                                    <div class="prs_in_right_box_img_cont_wrapper">
                                        <h2><a href="#">The News of theater</a></h2>
                                        <h3>28 feb 2018</h3>
                                        <p>Lorem ipsum dolor sit amet, consectuir adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore.</p>
                                        <ul>
                                            <li><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<a href="#">120
                                                    Like</a>
                                            </li>
                                            <li><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<a href="#">52
                                                    comments</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_ln_right_first_box_wrapper2">
                                    <div class="prs_in_right_box_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/nl3.jpg') }}" alt="news_img" />
                                    </div>
                                    <div class="prs_in_right_box_img_cont_wrapper">
                                        <h2><a href="#">The News of theater</a></h2>
                                        <h3>28 feb 2018</h3>
                                        <p>Lorem ipsum dolor sit amet, consectuir adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore.</p>
                                        <ul>
                                            <li><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<a href="#">120
                                                    Like</a>
                                            </li>
                                            <li><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<a href="#">52
                                                    comments</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs letest news End -->
    <!-- prs feature slider Start -->
    <div class="prs_feature_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>FEATURED EVENTS</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_feature_slider_wrapper">
                        <div class="owl-carousel owl-theme">
                            <div class="item prs_feature_slider_item_wrapper">
                                <div class="prs_feature_img_box_wrapper">
                                    <div class="prs_feature_img">
                                        <img src="{{ asset('theme/client/images/content/ft1.jpg') }}" alt="feature_img">
                                        <div class="prs_ft_btn_wrapper">
                                            <ul>
                                                <li><a href="#">Book Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="prs_feature_img_cont">
                                        <h2><a href="#">Music Event in india</a></h2>
                                        <div class="prs_ft_small_cont_left">
                                            <p>Mumbai & Pune</p>
                                        </div>
                                        <div class="prs_ft_small_cont_right"> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <ul>
                                            <li>June 07 - july 08</li>
                                            <li>08:00-12:00 pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item prs_feature_slider_item_wrapper">
                                <div class="prs_feature_img_box_wrapper">
                                    <div class="prs_feature_img">
                                        <img src="{{ asset('theme/client/images/content/ft2.jpg') }}" alt="feature_img">
                                        <div class="prs_ft_btn_wrapper">
                                            <ul>
                                                <li><a href="#">Book Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="prs_feature_img_cont">
                                        <h2><a href="#">Music Event in india</a></h2>
                                        <div class="prs_ft_small_cont_left">
                                            <p>Mumbai & Pune</p>
                                        </div>
                                        <div class="prs_ft_small_cont_right"> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <ul>
                                            <li>June 07 - july 08</li>
                                            <li>08:00-12:00 pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item prs_feature_slider_item_wrapper">
                                <div class="prs_feature_img_box_wrapper">
                                    <div class="prs_feature_img">
                                        <img src="{{ asset('theme/client/images/content/ft3.jpg') }}" alt="feature_img">
                                        <div class="prs_ft_btn_wrapper">
                                            <ul>
                                                <li><a href="#">Book Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="prs_feature_img_cont">
                                        <h2><a href="#">Music Event in india</a></h2>
                                        <div class="prs_ft_small_cont_left">
                                            <p>Mumbai & Pune</p>
                                        </div>
                                        <div class="prs_ft_small_cont_right"> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <ul>
                                            <li>June 07 - july 08</li>
                                            <li>08:00-12:00 pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs feature slider End -->
    <!-- prs videos&photos slider Start -->
    <div class="prs_vp_main_section_wrapper">
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
    </div>
    <!-- prs videos&photos slider End -->
    <!-- prs patner slider Start -->


    @include('client.showtime')
@endsection


@section('style-libs')
    {{-- <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('load-more2').addEventListener('click', function() {
                const button = this;
                const page = button.getAttribute('data-page');

                fetch(`/api/movies?page=${page}`, {
                        method: 'GET',

                    })
                    .then(response => response.text()) // Đảm bảo nhận về dữ liệu dạng text (HTML)
                    .then(data => {
                        const movieList = document.getElementById('movie-list2');
                        // console.log(data);

                        if (data.trim().length > 0) {
                            movieList.innerHTML += data;

                        } else {
                            // Nếu không có phim để thêm, ẩn nút "Xem thêm"
                            button.style.display = 'none';
                        }

                        button.setAttribute('data-page', parseInt(page) + 1);
                    })
                    .catch(error => console.error('Error:', error));

            });

            document.getElementById('load-more1').addEventListener('click', function() {
                const button = this;
                const page = button.getAttribute('data-page');

                fetch(`/api/movies1?page=${page}`, {
                        method: 'GET',

                    })
                    .then(response => response.text()) // Đảm bảo nhận về dữ liệu dạng text (HTML)
                    .then(data => {
                        const movieList = document.getElementById('movie-list1');
                        // console.log(data);

                        if (data.trim().length > 0) {
                            movieList.innerHTML += data;

                        } else {
                            // Nếu không có phim để thêm, ẩn nút "Xem thêm"
                            button.style.display = 'none';
                        }

                        button.setAttribute('data-page', parseInt(page) + 1);
                    })
                    .catch(error => console.error('Error:', error));

            });

            document.getElementById('load-more3').addEventListener('click', function() {
                const button = this;
                const page = button.getAttribute('data-page');

                fetch(`/api/movies3?page=${page}`, {
                        method: 'GET',

                    })
                    .then(response => response.text()) // Đảm bảo nhận về dữ liệu dạng text (HTML)
                    .then(data => {
                        const movieList = document.getElementById('movie-list3');
                        // console.log(data);

                        if (data.trim().length > 0) {
                            movieList.innerHTML += data;

                        } else {
                            // Nếu không có phim để thêm, ẩn nút "Xem thêm"
                            button.style.display = 'none';
                        }

                        button.setAttribute('data-page', parseInt(page) + 1);
                    })
                    .catch(error => console.error('Error:', error));

            });




        });
    </script>
@endsection
