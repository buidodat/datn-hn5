@extends('client.layouts.master')

@section('title')
    Danh sách phim
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/showtime.css') }}" />
@endsection

@section('content')
    <div class="prs_upcom_slider_main_wrapper" style='padding-bottom:80px'>
        <div class="container">
            <div class="row-pro-max">
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
                                            <div class="movie_box_wrapper">
                                                <div class="movie_img_box">
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
                                                    <div class='movie_img_trailer'>
                                                        <div class='animation-icon open-trailer-btn'
                                                            data-trailer-url="https://www.youtube.com/embed/{{ $movie->trailer_url }}"
                                                            data-movie-name="{{ $movie->name }}">
                                                            <img src="{{ asset('theme/client/images/index_III/icon.png') }}"
                                                                alt="img">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="content-movie">
                                                    <h3 class="movie-name-home">
                                                        <a
                                                            href="movies/{{ $movie->slug }}">{{ Str::limit($movie->name, 19) }}</a>
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
                    </div>
                    {{-- Phim đang chiếu --}}
                    <div role="tabpanel" class="tab-pane fade  in active" id="hot">
                        <div class="tab-pane-content-movie-list">
                            <div class="item">
                                <div class="row" id="movie-list2">
                                    {{-- @dd($moviesShowing) --}}
                                    @foreach ($moviesShowing as $movie)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="movie_box_wrapper">
                                                <div class="movie_img_box">
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
                                                    <div class='movie_img_trailer'>
                                                        <div class='animation-icon open-trailer-btn'
                                                            data-trailer-url="https://www.youtube.com/embed/{{ $movie->trailer_url }}"
                                                            data-movie-name="{{ $movie->name }}">
                                                            <img src="{{ asset('theme/client/images/index_III/icon.png') }}"
                                                                alt="img">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="content-movie">
                                                    <h3 class="movie-name-home">
                                                        <a
                                                            href="movies/{{ $movie->slug }}">{{ Str::limit($movie->name, 19) }}</a>
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
                    </div>
                    {{-- Suất chiếu đặc biệt --}}
                    <div role="tabpanel" class="tab-pane fade" id="trand">
                        <div class="tab-pane-content-movie-list">
                            <div class="item">
                                <div class="row" id="movie-list3">
                                    @foreach ($moviesSpecial as $movie)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="movie_box_wrapper">
                                                <div class="movie_img_box">
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
                                                    <div class='movie_img_trailer'>
                                                        <div class='animation-icon open-trailer-btn'
                                                            data-trailer-url="https://www.youtube.com/embed/{{ $movie->trailer_url }}"
                                                            data-movie-name="{{ $movie->name }}">
                                                            <img src="{{ asset('theme/client/images/index_III/icon.png') }}"
                                                                alt="img">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="content-movie">
                                                    <h3 class="movie-name-home">
                                                        <a
                                                            href="movies/{{ $movie->slug }}">{{ Str::limit($movie->name, 19) }}</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('client.modals.movie-trailler')
    @include('client.modals.movie-screning')
@endsection

@section('scripts')
<script src="{{ asset('theme/client/js/trailler.js') }}"></script>
    <script src="{{ asset('theme/client/js/showtime.js') }}"></script>
@endsection
