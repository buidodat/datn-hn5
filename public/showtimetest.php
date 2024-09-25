@php
    $dates = [];
    $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];

    // Lấy ngày hiện tại
    $currentDate = new DateTime();

    for ($i = 0; $i < 7; $i++) {
        // Tạo format ngày: dd/mm - Thứ
        $dayOfWeek = $currentDate->format('w'); // Lấy chỉ số ngày trong tuần (0 = CN, 1 = T2,...)
        $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$dayOfWeek]; // 24/09 -T3

        // Lấy lịch chiếu cho ngày này
        $showtimes = DB::table('showtimes')
            ->where('movie_id', $movie->id) // Lấy lịch chiếu theo ID phim
            ->whereDate('date', $currentDate) // Lấy lịch chiếu cho ngày này
            ->where('start_time', '>', now()) // Chỉ lấy start_time lớn hơn thời gian hiện tại
            ->orderBy('start_time', 'asc') // Sắp xếp thời gian tăng dần
            ->get();

        // Thêm vào mảng $dates chỉ nếu có lịch chiếu
        if (!$showtimes->isEmpty()) {
            $dates[] = [
                'day_id' => 'day' . $currentDate->format('z'), // z: day of year
                'date_label' => $formattedDate,
                'showtimes' => $showtimes,
            ];
        }

        // Cộng thêm 1 ngày
        $currentDate->add(new DateInterval('P1D'));
    }
@endphp

<div id="modalMovieScrening" class="modalMovieScrening">
    <div class="modalMovieScrening-content">

        <!-- Modal Header -->
        <div class="modalMovieScrening-header">
            <span class="modalMovieScrening-title">LỊCH CHIẾU - {{ $movie->name }}</span>
            <span class="closeModalMovieScrening">&times;</span>
        </div>

        <!-- Modal Body -->

        <div class="modalMovieScrening-body">
            <h2 class="cinema-title">Rạp Poly Hà đông   </h2>
            <!-- Date Picker -->
            <div class="listMovieScrening-date">
                @foreach ($dates as $index => $date)
                    <div data-day="{{ $date['day_id'] }}" class="movieScrening-date-item {{ $index == 0 ? 'active' : '' }}">
                        {{ $date['date_label'] }}
                    </div>
                @endforeach
            </div>

            <!-- Showtimes -->
            @foreach ($dates as $date)
                <div class="movieScrening-list-showtime-day" id="{{ $date['day_id'] }}">
                    <div class="movieScrening-showtime-version">
                        <h4 class="version-movie">2D phụ đề</h4>
                        <div class="list-showtimes">
                            @foreach ($date['showtimes'] as $showtime)
                                <div class="showtime-item">
                                    <div class="showtime-item-start-time">{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</div>
                                    <div class="empty-seat-showtime"> 150 ghế trống</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

