@extends('client.layouts.master')

@section('title')
    Lịch chiếu
@endsection

@section('content')
    <div class="st_slider_index_sidebar_main_wrapper st_slider_index_sidebar_main_wrapper_md">
        <div class="container">
            <div class="">
                <!-- Tabs hiển thị các ngày trong tuần -->
                <div class="modalMovieScrening-body">
                    <!-- Date Picker -->
                    <div class="listMovieScrening-date">
                        <div data-day="day250" class="movieScrening-date-item active">23/09 - T2</div>
                        <div data-day="day251" class="movieScrening-date-item">24/09 - T3</div>
                        <div data-day="day252" class="movieScrening-date-item">25/09 - T4</div>
                        <div data-day="day253" class="movieScrening-date-item">26/09 - T5</div>
                        <div data-day="day254" class="movieScrening-date-item">27/09 - T6</div>
                        <div data-day="day255" class="movieScrening-date-item">28/09 - T7</div>
                        <div data-day="day256" class="movieScrening-date-item">29/09 - CN</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-8">
                        <div class="col-md-4 image-movie-detail">
                            <img src="https://files.betacorp.vn/media%2fimages%2f2024%2f09%2f19%2f482wx722h%2D162630%2D190924%2D83.jpg"
                                class="movie-poster">
                        </div>
                        <div class="movie-detail-content">
                            <h1 class="movie-title">Cám</h1>
                            <ul class="movie-info">
                                <li><strong>Thể loại:</strong> Kinh dị</li>
                                <li><strong>Thời lượng:</strong> 122 phút</li>
                            </ul>
                            <!-- Lịch chiếu phim -->
                            <div class="showtime-section">
                                <h4 class="showtime-title">2D phụ đề</h4>
                                <div class="showtime-list">
                                    <button class="showtime-btn">09:30</button>
                                    <button class="showtime-btn">11:45</button>
                                    <button class="showtime-btn">12:45</button>
                                    <button class="showtime-btn">14:00</button>
                                    <button class="showtime-btn">16:15</button>
                                    <button class="showtime-btn">18:45</button>
                                    <button class="showtime-btn">20:00</button>
                                    <button class="showtime-btn">22:15</button>
                                    <button class="showtime-btn">23:10</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-8">
                        <div class="col-md-4 image-movie-detail">
                            <img src="https://files.betacorp.vn/media%2fimages%2f2024%2f09%2f19%2f482wx722h%2D162630%2D190924%2D83.jpg"
                                class="movie-poster">
                        </div>
                        <div class="movie-detail-content">
                            <h1 class="movie-title">Cám</h1>
                            <ul class="movie-info">
                                <li><strong>Thể loại:</strong> Kinh dị</li>
                                <li><strong>Thời lượng:</strong> 122 phút</li>
                            </ul>
                            <!-- Lịch chiếu phim -->
                            <div class="showtime-section">
                                <h4 class="showtime-title">2D phụ đề</h4>
                                <div class="showtime-list">
                                    <button class="showtime-btn">09:30</button>
                                    <button class="showtime-btn">11:45</button>
                                    <button class="showtime-btn">12:45</button>
                                    <button class="showtime-btn">14:00</button>
                                    <button class="showtime-btn">16:15</button>
                                    <button class="showtime-btn">18:45</button>
                                    <button class="showtime-btn">20:00</button>
                                    <button class="showtime-btn">22:15</button>
                                    <button class="showtime-btn">23:10</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        hr {
            border: 0;
            /* Loại bỏ đường viền mặc định */
            border-top: 3px solid rgb(214, 213, 213);
            /* Đặt màu và độ dày của đường */
            margin: 30px 0;
            /* Tùy chỉnh khoảng cách trên và dưới */
            width: 100%;
            /* Chiều rộng của hr */
        }

        /* Style cho các tab ngày */
        .listMovieScrening-date {
            display: flex;
            flex-wrap: wrap;
            /* Đảm bảo các phần tử tự động xuống dòng */
            justify-content: flex-start;
            /* Sắp xếp từ trái qua phải */
            padding: 0 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .listMovieScrening-date div {
            cursor: pointer;
            font-size: 18px;
            font-weight: normal;
            color: rgb(46, 46, 46);
            padding: 10px 10px;
            margin: 17px 16px;
            flex: 0 1 auto;
            /* Cho phép các phần tử co giãn */
            font-size: 21px;
            font-weight: 600;
        }

        .listMovieScrening-date div.active {
            color: #fb1d1d;
            font-weight: bold;
            border-bottom: 3px solid #fb1d1d;
        }

        /* Style cho phần chi tiết phim */
        .image-movie-detail {
            text-align: center;
            width: 360px;
        }

        .movie-poster {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .movie-title {
            font-size: 30px;
            font-weight: bold;
            margin-top: 10px;
        }

        .movie-info {
            list-style: none;
            padding: 0;
            margin-top: 15px;
        }

        .movie-info li {
            font-size: 14px;
            margin-bottom: 5px;
        }

        /* Style cho phần lịch chiếu */
        .showtime-section {
            margin-top: 30px;
        }

        .showtime-title {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .showtime-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .showtime-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #f1f1f1;
            position: relative;
            font-weight: 600;
        }

        .showtime-btn:hover {
            color: red;
        }

        /* Khi button được chọn */
        .showtime-btn.selected {
            color: red;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Xử lý cho các nút lịch chiếu (showtime)
        document.querySelectorAll('.showtime-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.showtime-btn').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Xử lý cho các tab ngày
        document.querySelectorAll('.movieScrening-date-item').forEach(tab => {
            tab.addEventListener('click', function(event) {
                document.querySelectorAll('.movieScrening-date-item').forEach(btn => btn.classList.remove(
                    'active'));
                this.classList.add('active');
            });
        });
    </script>
@endsection
