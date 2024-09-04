@extends('client.layouts.master')

@section('title')
    Movie Detail
@endsection

@section('content')
    <!-- prs video top Start -->
    <div class="prs_top_video_section_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="st_video_slider_inner_wrapper float_left " style="height:400px">
                        <div class="st_video_slider_overlay"></div>
                        <div class="st_video_slide_sec float_left mt-5">
                            <a rel='external' href='https://www.youtube.com/embed/ryzOXAO0Ss0' title='title'
                                class="test-popup-link">
                                <img src="{{ env('APP_URL') . '/theme/client/' }}images/index_III/icon.png" alt="img">
                            </a>
                            <h3>Trailler</h3>
                        </div>
                        <div class="st_video_slide_social float_left">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- prs video top End -->
        <!-- st slider rating wrapper Start -->

        <!-- st slider rating wrapper End -->
        <!-- st slider sidebar wrapper Start -->
        <div class="st_slider_index_sidebar_main_wrapper st_slider_index_sidebar_main_wrapper_md float_left">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="st_indx_slider_main_container float_left">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row ">
                                        <div class="col-md-4 image-movie-detail">
                                            <img src="https://media.lottecinemavn.com/Media/MovieFile/MovieImg/202408/11514_103_100003.jpg"
                                                alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="movie-detail-content">
                                                <div class="title  ">
                                                    <h1>Phim Ma Da Hiếu Sợ Khóc Huhu</h1>
                                                </div>
                                                <div class="description">
                                                    <p>
                                                        Hellboy và một điệp viên BPRD mới vào nghề bị mắc kẹt ở
                                                        vùng nông thôn Appalachia những năm 1950 và phát hiện ra một cộng đồng nhỏ
                                                        bị phù thủy ám ảnh, do Crooked Man đứng đầu.
                                                    </p>
                                                </div>
                                                <hr>
                                                <div class="details ">
                                                    <ul >
                                                        <li>
                                                            <strong>Phân loại:</strong> T16
                                                        </li>
                                                        <li>
                                                            <strong>Định dạng:</strong> 2D
                                                        </li>
                                                        <li>
                                                            <strong>Đạo diễn:</strong> Brian Taylor
                                                        </li>
                                                        <li>
                                                            <strong>Diễn viên:</strong> Jack Kesy, Jefferson White
                                                        </li>
                                                        <li>
                                                            <strong>Thể loại:</strong> Action
                                                        </li>
                                                        <li>
                                                            <strong>Khởi chiếu:</strong> 30/08/2024
                                                        </li>
                                                        <li>
                                                            <strong>Thời lượng:</strong> 100 phút
                                                        </li>
                                                        <li>
                                                            <strong>Ngôn ngữ:</strong> Phụ đề
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="buttons">
                                                    <a rel='external'  title='title'
                                                    class=""><button class="watch-trailer">Xem Trailer</button></a>
                                                    <button class="buy-ticket" id="buy-ticket-btn">Mua Vé Ngay</button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="review-section">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="ne_recent_heading_main_wrapper ne_recent_heading_main_wrapper_index_II float_left title-rating">
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
                                                                    <textarea placeholder="Vui lòng viết đánh giá phim." maxlength="220"></textarea>
                                                                </div>
                                                                <div class='button-submit-comment'>
                                                                    <button class="submit-review">Bình luận</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="hr-black">
                                                <div class="review-list">
                                                    <!-- Một bình luận -->
                                                    <div class="review">
                                                        <div class="review-header">
                                                            <span class="reviewer-name">Khách</span>
                                                            <div class="review-rating">
                                                                <span class="star">&#9733;</span>
                                                                <span class="star">&#9733;</span>
                                                                <span class="star empty">&#9733;</span>
                                                                <span class="star empty">&#9733;</span>
                                                                <span class="star empty">&#9733;</span>
                                                                <span class="review-score">2</span>
                                                            </div>
                                                        </div>
                                                        <p class="review-content">Dở</p>
                                                        <div class="review-footer">
                                                            <span class="review-date">29/08/2024</span>
                                                            <span class="review-likes">| &#128077; 0</span>
                                                        </div>
                                                    </div>
                                                    <div class="review">
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
                                                    </div>
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
        @include('client.showtime')
        <!-- st slider sidebar wrapper End -->
    @endsection
