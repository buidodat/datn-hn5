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
                                    <div class="row">
                                        <div class="col-md-4 image-movie-detail">
                                            <img src="https://media.lottecinemavn.com/Media/MovieFile/MovieImg/202408/11514_103_100003.jpg"
                                                alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <h1>Làm giàu không khó</h1>
                                            <hr>

                                            <ul class="details">
                                                <li><strong>Phân loại:</strong> <span class="badge">T16</span> Phim phổ
                                                    biến đến người xem từ 16 tuổi trở lên</li>
                                                <li><strong>Định dạng:</strong> <span class="badge">2D</span></li>
                                                <li><strong>Đạo diễn:</strong> Brian Taylor</li>
                                                <li><strong>Diễn viên:</strong> Jack Kesy, Jefferson White</li>
                                                <li><strong>Thể loại:</strong> Action</li>
                                                <li><strong>Khởi chiếu:</strong> 30/08/2024</li>
                                                <li><strong>Thời lượng:</strong> 100 phút</li>
                                                <li><strong>Ngôn ngữ:</strong> Phụ đề</li>
                                            </ul>
                                            <div class="buttons">
                                                <button class="buy-ticket">Mua Vé Ngay</button>
                                                <button class="watch-trailer">Xem Trailer</button>
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
        <!-- st slider sidebar wrapper End -->
    @endsection
