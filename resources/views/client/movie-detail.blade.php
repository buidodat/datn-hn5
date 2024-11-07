@extends('client.layouts.master')

@section('title')
    Chi tiết phim
@endsection


@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/showtime.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/binhluan.css') }}" />
@endsection

@section('content')
    <div class="st_slider_index_sidebar_main_wrapper st_slider_index_sidebar_main_wrapper_md float_left">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="st_indx_slider_main_container float_left">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-4 image-movie-detail">
                                        @php
                                            $url = $movie->img_thumbnail;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" height="">
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="movie-detail-content">
                                            <div class="title-movie-detail">
                                                <h1>{{ $movie->name }}</h1>
                                            </div>
                                            <div class="description">
                                                <p>
                                                    {{ $movie->description }}
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="details ">
                                                <ul>
                                                    <li>
                                                        <strong>Phân loại:</strong> {{ $movie->rating }}
                                                    </li>

                                                    <li>
                                                        <strong>Đạo diễn:</strong> {{ $movie->director }}
                                                    </li>
                                                    <li>
                                                        <strong>Diễn viên:</strong> {{ $movie->cast }}
                                                    </li>
                                                    <li>
                                                        <strong>Thể loại:</strong> {{ $movie->category }}
                                                    </li>
                                                    <li>
                                                        <strong>Khởi chiếu:</strong> {{ $movie->release_date }}
                                                    </li>
                                                    <li>
                                                        <strong>Thời lượng:</strong> {{ $movie->duration }} phút
                                                    </li>
                                                    <li>
                                                        <strong>Ngôn ngữ:</strong> Vietsub
                                                    </li>
                                                </ul>
                                            </div>
                                            @php
                                                // Kiểm tra có suất chiếu trong 7 ngày tới tại cinema_id
                                                $hasShowtimeInNextWeek = $movie
                                                    ->showtimes()
                                                    ->where('cinema_id', session('cinema_id')) // Kiểm tra theo cinema_id
                                                    ->whereBetween('start_time', [$currentNow, $endDate])
                                                    ->exists();
                                            @endphp

                                            <div class="buttons">
                                                <button class="watch-trailer" id='openModalBtn-trailer'>Xem
                                                    Trailer
                                                </button>
                                                @if ($hasShowtimeInNextWeek)
                                                    <button class="buy-ticket"
                                                        onclick="openModalMovieScrening({{ $movie->id }})">Mua Vé Ngay
                                                    </button>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="review-section">
                                            {{-- <div class="row">
                                                <div class="col-md-12">
                                                    <div
                                                        class="ne_recent_heading_main_wrapper ne_recent_heading_main_wrapper_index_II float_left title-rating">
                                                        <h2>Xếp hạng và đánh giá phim</h2>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form">
                                                        <div class="rating-input">
                                                            <div class="stars">
                                                                <span class="star" data-value="1">&#9733;</span>
                                                                <span class="star" data-value="2">&#9733;</span>
                                                                <span class="star" data-value="3">&#9733;</span>
                                                                <span class="star" data-value="4">&#9733;</span>
                                                                <span class="star" data-value="5">&#9733;</span>
                                                            </div>
                                                            <span class="rating-score">0 điểm</span>
                                                        </div>
                                                        <div class="form-comment">
                                                            <div class="form-textarea">
                                                                <textarea class="textarea-comment"placeholder="Vui lòng viết đánh giá phim." maxlength="220"></textarea>
                                                            </div>
                                                            <div class='button-submit-comment'>
                                                                <button class="submit-review">Đánh giá</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div
                                                        class="ne_recent_heading_main_wrapper ne_recent_heading_main_wrapper_index_II float_left title-rating">
                                                        <h2>Xếp hạng và đánh giá phim</h2>
                                                    </div>
                                                </div>
                                                @auth
                                                    <div class="col-md-12">
                                                        <div class="rating-form">
                                                            <form method="POST"
                                                                action="{{ route('movies.addReview', ['slug' => $movie->slug]) }}">
                                                                @csrf
                                                                @if (!$userReviewed)
                                                                    <div class="form-comment">
                                                                        <div class="st_rating_box">
                                                                            <fieldset class="rating">
                                                                                <h5>Xếp hạng</h5>
                                                                                <input type="radio" id="star5"
                                                                                    name="rating" value="10" />
                                                                                <label for="star5" class="full"
                                                                                    title="10 stars"></label>

                                                                                <input type="radio" id="star4half"
                                                                                    name="rating" value="9" />
                                                                                <label for="star4half" class="half"
                                                                                    title="9 stars"></label>

                                                                                <input type="radio" id="star4"
                                                                                    name="rating" value="8" />
                                                                                <label for="star4" class="full"
                                                                                    title="8 stars"></label>

                                                                                <input type="radio" id="star3half"
                                                                                    name="rating" value="7" />
                                                                                <label for="star3half" class="half"
                                                                                    title="7 stars"></label>

                                                                                <input type="radio" id="star3"
                                                                                    name="rating" value="6" />
                                                                                <label for="star3" class="full"
                                                                                    title="6 stars"></label>

                                                                                <input type="radio" id="star2half"
                                                                                    name="rating" value="5" />
                                                                                <label for="star2half" class="half"
                                                                                    title="5 stars"></label>

                                                                                <input type="radio" id="star2"
                                                                                    name="rating" value="4" />
                                                                                <label for="star2" class="full"
                                                                                    title="4 stars"></label>

                                                                                <input type="radio" id="star1half"
                                                                                    name="rating" value="3" />
                                                                                <label for="star1half" class="half"
                                                                                    title="3 stars"></label>

                                                                                <input type="radio" id="star1"
                                                                                    name="rating" value="2" />
                                                                                <label for="star1" class="full"
                                                                                    title="2 star"></label>

                                                                                <input type="radio" id="starhalf"
                                                                                    name="rating" value="1" />
                                                                                <label for="starhalf" class="half"
                                                                                    title="1 stars"></label>
                                                                                <p>0 điểm</p>
                                                                            </fieldset>

                                                                        </div>
                                                                        <div class="form-textarea">
                                                                            <textarea class="textarea-comment" name="description" placeholder="Vui lòng viết đánh giá phim." maxlength="220"></textarea>
                                                                        </div>
                                                                        <div class='button-submit-comment'>
                                                                            <button type="submit" class="submit-review"
                                                                                @if (session('userReviewed')) disabled @endif>
                                                                                Đánh giá
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <p>Bạn đã đánh giá phim một lần và không thể đánh
                                                                        giá hoặc chỉnh sửa thêm nữa.</p>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-12">
                                                        <p>Vui lòng <a style="color: #f1761d"
                                                                href="{{ route('login') }}">đăng nhập</a> để viết
                                                            đánh giá.</p>
                                                    </div>
                                                @endauth
                                            </div>
                                            <hr class="hr-black">
                                            <div class="review-list" id="comments">
                                                {{-- @foreach ($listBinhLuan as $index => $comment)
                                                    <div class="review">
                                                        <div class="review-header">
                                                            <span class="reviewer-name">{{$comment->user->name}}</span>
                                                            <div class="review-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $comment->rating)
                                                                        <span class="star">&#9733;</span>
                                                                    @else
                                                                        <span class="star empty">&#9733;</span>
                                                                    @endif
                                                                @endfor
                                                                <span class="review-score">{{$comment->rating}}</span>
                                                            </div>
                                                        </div>
                                                        <p class="review-content">{{$comment->description}}</p>
                                                        <div class="review-footer">
                                                            <span class="review-date">{{$comment->created_at}}</span>
                                                        </div>
                                                    </div>
                                                @endforeach --}}
                                            </div>
                                            <div class="content-cmt">
                                                <button id="prev" onclick="previousComments()" disabled>Trở
                                                    Lại</button>
                                                <button id="next" onclick="nextComments()">Tiếp Tục</button>
                                            </div>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="trailerModal-trailer" class="modal-trailer">
        <div class="modal-content-trailer">
            <span class="close-trailer">&times;</span>
            <h2>TRAILER - {{ $movie->name }}</h2>
            <hr>
            <div class="video-container-trailer">
                <iframe src="https://www.youtube.com/embed/{{ $movie->trailer_url }}" title="YouTube video"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>



    @include('client.modal-movie-screning')
    <!-- st slider sidebar wrapper End -->
@endsection

@section('scripts')
    <script src="{{ asset('theme/client/js/trailler.js') }}"></script>
    <script src="{{ asset('theme/client/js/showtime.js') }}"></script>
    <script>
        var movieId = {{ $movie->id }};
    </script>
    <script src="{{ asset('theme/client/js/binhluan.js') }}"></script>
@endsection
