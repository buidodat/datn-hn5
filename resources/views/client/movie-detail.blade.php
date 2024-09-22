@extends('client.layouts.master')

@section('title')
    Chi tiết phim
@endsection

@section('styles')
    <style>
        .content-cmt {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .content-cmt button {
            padding: 8px 17px;
            margin: 0 5px;
            font-size: 16px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .content-cmt button:disabled {
            background-color: #e0e0e0;
            border-color: #bbb;
            cursor: not-allowed;
        }

        .content-cmt button:hover:enabled {
            background-color: #f1761d;
            color: #fff;
            border-color: #f1761d;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
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
                                                    Trailer
                                                </button>

                                                <button class="buy-ticket" id="buy-ticket-btn">Mua Vé Ngay</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="review-section">
                                            {{--<div class="row">
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
                                            </div>--}}
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
                                                                  action="{{ route('movie.addReview', ['slug' => $movie->slug]) }}">
                                                                @csrf
                                                                @if(!$userReviewed)
                                                                    <div class="rating-input">
                                                                        <div class="stars" id="stars">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                <span class="star" data-value="{{ $i }}"
                                                                                      style="cursor: pointer;">&#9733;</span>
                                                                            @endfor
                                                                        </div>
                                                                        <input type="hidden" id="rating" name="rating"
                                                                               value="0">
                                                                        <span class="rating-score">0 điểm</span>
                                                                    </div>
                                                                    <div class="form-comment">
                                                                        <div class="form-textarea">
                                                                            <textarea class="textarea-comment"
                                                                                      name="description"
                                                                                      placeholder="Vui lòng viết đánh giá phim."
                                                                                      maxlength="220"></textarea>
                                                                        </div>
                                                                        <div class='button-submit-comment'>
                                                                            <button type="submit" class="submit-review"
                                                                                    @if(session('userReviewed')) disabled @endif>
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
                                                {{--@foreach($listBinhLuan as $index => $comment)
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
                                                @endforeach--}}
                                            </div>
                                            <div class="content-cmt">
                                                <button id="prev" onclick="previousComments()" disabled>Trở Lại</button>
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



    @include('client.showtime')
    <!-- st slider sidebar wrapper End -->
@endsection

@section('scripts')

    <script>
        let comments = [];
        let currentPage = 0;
        const perPage = 3;
        const movieId = {{ $movie->id }};

        function fetchComments() {
            fetch(`/movie/${movieId}/comments`)
                .then(response => response.json())
                .then(data => {
                    comments = data;
                    if (comments.length > perPage) {
                        document.getElementById('prev').style.visibility = 'visible';
                        document.getElementById('next').style.visibility = 'visible';
                    } else {
                        document.getElementById('prev').style.visibility = 'hidden';
                        document.getElementById('next').style.visibility = 'hidden';
                    }
                    showComments();
                })
                .catch(error => console.error('Lỗi khi tải bình luận:', error));
        }

        function showComments() {
            const start = currentPage * perPage;
            const selectedComments = comments.slice(start, start + perPage);

            let html = '';

            selectedComments.forEach(comment => {
                html += `
        <div class="review">
            <div class="review-header">
                <span class="reviewer-name">${comment.user.name}</span>
                <div class="review-rating">
        `;

                for (let i = 1; i <= 5; i++) {
                    if (i <= comment.rating) {
                        html += `<span class="star">&#9733;</span>`;
                    } else {
                        html += `<span class="star empty">&#9733;</span>`;
                    }
                }

                html += `
                <span class="review-score">${comment.rating}</span>
                </div>
            </div>
            <p class="review-content">${comment.description}</p>
            <div class="review-footer">
                <span class="review-date">${new Date(comment.created_at).toLocaleDateString()}</span>
            </div>
        </div>
        `;
            });

            document.getElementById('comments').innerHTML = html;

            document.getElementById('prev').disabled = currentPage === 0;
            document.getElementById('next').disabled = (currentPage + 1) * perPage >= comments.length;
        }

        function nextComments() {
            if ((currentPage + 1) * perPage < comments.length) {
                currentPage++;
                showComments();
            }
        }

        function previousComments() {
            if (currentPage > 0) {
                currentPage--;
                showComments();
            }
        }

        fetchComments();
    </script>

@endsection
