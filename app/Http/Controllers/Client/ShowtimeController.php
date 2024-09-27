<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon để xử lý ngày tháng
use Illuminate\Support\Facades\DB;

class ShowtimeController extends Controller
{    
    public function show($slug)
    {
        $cinema = Cinema::where('slug', $slug)->firstOrFail();
    
        // Lấy tất cả các showtimes có cinema_id bằng với ID của cinema
        $showtimes = Showtime::with('movie', 'room')
            ->where('cinema_id', $cinema->id)
            ->get();
    
        // Truy vấn lịch chiếu
        $dates = [];
        $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
        $currentDate = now(); // Sử dụng Carbon để làm việc với ngày giờ
    
        // Thiết lập thời gian tối thiểu cho suất chiếu (20:00)
        $minShowtime = now()->setTime(20, 0); // 20:00 hôm nay
    
        for ($i = 0; $i < 7; $i++) {
            // Định dạng ngày
            $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$currentDate->dayOfWeek];
    
            // Nhóm showtimes theo ngày và phim
            $filteredShowtimes = $showtimes->filter(function ($showtime) use ($currentDate, $minShowtime) {
                return $showtime->date == $currentDate->format('Y-m-d') 
                    && $showtime->start_time > $minShowtime; // Chỉ lấy suất chiếu sau 20:00
            })->groupBy('movie.id'); // Nhóm theo phim
    
            // Sắp xếp suất chiếu theo giờ từ bé đến lớn
            foreach ($filteredShowtimes as $movieId => $showtimesGroup) {
                $filteredShowtimes[$movieId] = $showtimesGroup->sortBy('start_time'); // Sắp xếp theo start_time
            }
    
            if (!$filteredShowtimes->isEmpty()) {
                $dates[] = [
                    'day_id' => 'day' . $currentDate->format('z'),
                    'date_label' => $formattedDate,
                    'showtimes' => $filteredShowtimes,
                ];
            }
    
            // Cộng thêm 1 ngày
            $currentDate->addDay();
        }
    
        return view('client.showtimes', compact('dates', 'cinema')); // Truyền thêm thông tin cinema nếu cần
    }
    
    
    
    

    
}
