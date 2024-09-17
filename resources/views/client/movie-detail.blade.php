@extends('client.layouts.master')

@section('title')
    Chi tiết phim
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


                                        <img src="{{ $url }}"
                                            alt="" height="">
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

                                            <div class="buttons">
                                                <button class="watch-trailer" id='openModalBtn-trailer'>Xem
                                                    Trailer</button>

                                                <button class="buy-ticket" id="buy-ticket-btn">Mua Vé Ngay</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="review-section">
                                            <div class="row">
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
                                            </div>
                                            <hr class="hr-black">
                                            <div class="review-list">
                                                <!-- Một bình luận -->
                                                @foreach($listBinhLuan as $index => $comment)
                                                <div class="review">
                                                    <div class="review-header">
                                                        <span class="reviewer-name">{{$comment->user->name}}</span>
                                                        <div class="review-rating">
                                                            <span class="star">&#9733;</span>
                                                            <span class="star">&#9733;</span>
                                                            <span class="star empty">&#9733;</span>
                                                            <span class="star empty">&#9733;</span>
                                                            <span class="star empty">&#9733;</span>
                                                            <span class="review-score">{{$comment->rating}}</span>
                                                        </div>
                                                    </div>
                                                    <p class="review-content">{{$comment->description}}</p>
                                                    <div class="review-footer">
                                                        <span class="review-date">{{$comment->created_at}}</span>
                                                        <span class="review-likes">| &#128077; 0</span>
                                                    </div>
                                                </div>
                                                @endforeach

                                                {{--<div class="review">
                                                    <div class="review-header">
                                                        <span class="reviewer-name">Khách</span>
                                                        <div class="review-rating">
                                                            <span class="star">&#9733;</span>
                                                            <span class="star">&#9733;</span>
                                                            <span class="star ">&#9733;</span>
                                                            <span class="star ">&#9733;</span>
                                                            <span class="star ">&#9733;</span>
                                                            <span class="review-score">5</span>
                                                        </div>
                                                    </div>
                                                    <p class="review-content">Phim quá hay luôn tuyệt vời</p>
                                                    <div class="review-footer">
                                                        <span class="review-date">27/08/2024</span>
                                                        <span class="review-likes">| &#128077; 3</span>
                                                    </div>
                                                </div>--}}
                                                <!-- Thêm nhiều bình luận tương tự -->
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
                <iframe src="https://www.youtube.com/embed/{{ $movie->trailer_url }}" title="YouTube video" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    @include('client.showtime')
    <!-- st slider sidebar wrapper End -->
@endsection
