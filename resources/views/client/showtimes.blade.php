@extends('client.layouts.master')

@section('title')
    Lịch chiếu
@endsection

@section('content')
    
        <div class="container">
            <div class="">
                <!-- Tabs hiển thị các ngày trong tuần -->
                <div class="top-bot">
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
                <hr>
            </div>
        </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/showtimes-cenima.css') }}" />
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
