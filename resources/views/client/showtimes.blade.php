@extends('client.layouts.master')

@section('title')
    Lịch chiếu
@endsection

@section('content')
    <div class="container">
        <div class="">
            <!-- Tabs hiển thị các ngày trong tuần -->
            @if (isset($dates) && count($dates) > 0)
                <div class="top-bot">
                    <!-- Date Picker -->
                    <div class="listMovieScrening-date">
                        @foreach ($dates as $date)
                            <div data-day="{{ $date['day_id'] }}"
                                class="movieScrening-date-item {{ $loop->first ? 'active' : '' }}">
                                {{ $date['date_label'] }}
                            </div>
                        @endforeach
                    </div>
                </div>


                @foreach ($dates as $date)
                    <div class="row" data-day="{{ $date['day_id'] }}" style="{{ $loop->first ? '' : 'display:none;' }}">
                        <!-- Chỉ hiển thị hàng đầu tiên -->
                        @foreach ($date['showtimes'] as $movieId => $showtimes)
                            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-8" style="margin-bottom: 30px">
                                <div class="col-md-4 image-movie-detail">
                                    <img src="{{ $showtimes->first()->movie->img_thumbnail }}" class="movie-poster">
                                </div>
                                <div class="movie-detail-content">
                                    <h1 class="movie-title">{{ $showtimes->first()->movie->name }}</h1>
                                    <ul class="movie-info">
                                        <li><strong>Thể loại:</strong> {{ $showtimes->first()->movie->category }}</li>
                                        <li><strong>Thời lượng:</strong> {{ $showtimes->first()->movie->duration }} phút
                                        </li>
                                    </ul>
                                    <!-- Lịch chiếu phim -->
                                    <div class="showtime-section">
                                        @foreach ($showtimes->groupBy('format') as $format => $times)
                                            <div style="margin-bottom: 20px">
                                                <h4 class="showtime-title">{{ $format }}</h4>
                                                <div class="showtime-list">
                                                    @foreach ($times as $showtime)
                                                        <a href="{{ route('choose-seat', $showtime->id) }}"
                                                            class="showtime-btn">
                                                            {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div style="margin: 130px 0px 300px 0px;">
                    <p style="text-align: center; font-size: 30px;">Hiện tại rạp đang không có suất chiếu nào!</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/showtimes-cinema.css') }}" />
@endsection

@section('scripts')
    <script>
        // Xử lý cho các tab ngày
        document.querySelectorAll('.movieScrening-date-item').forEach(tab => {
            tab.addEventListener('click', function(event) {
                // Xóa lớp active khỏi tất cả các tab
                document.querySelectorAll('.movieScrening-date-item').forEach(btn => btn.classList.remove(
                    'active'));
                this.classList.add('active');

                // Lấy ID ngày đã chọn
                const dayId = this.getAttribute('data-day');

                // Ẩn tất cả các hàng lịch chiếu
                document.querySelectorAll('.row').forEach(row => {
                    // Ẩn tất cả các hàng
                    row.style.display = 'none';
                });

                // Hiển thị lịch chiếu cho ngày đã chọn
                const selectedRow = document.querySelector(`.row[data-day="${dayId}"]`);
                if (selectedRow) {
                    selectedRow.style.display = 'block'; // Hiện hàng cho ngày đã chọn
                }
            });
        });
    </script>
@endsection
