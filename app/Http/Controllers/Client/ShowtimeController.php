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
    // public function show($slug)
    // {
    //     // Tìm cinema dựa trên slug được truyền vào từ URL
    //     $cinema = Cinema::where('slug', $slug)->firstOrFail();
    
    //     $showtimes = Showtime::with('movie', 'movieVersion', 'room')
    //                           ->where('cinema_id', $cinema->id)
    //                           ->get();
    
    //     dd($showtimes->movie()->toArray());
    
    //     return view('client.showtimes', compact('showtimes'));
    // }

    public function show($slug)
{
    // Tìm cinema dựa trên slug được truyền vào từ URL
    $cinema = Cinema::where('slug', $slug)->firstOrFail();

    // Lấy tất cả các showtimes có cinema_id bằng với ID của cinema
    $showtimes = Showtime::with('movie', 'movieVersion', 'room')
                          ->where('cinema_id', $cinema->id)
                          ->get();

    // Truy vấn lịch chiếu
    $dates = [];
    $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];

    // Lấy ngày hiện tại
    $currentDate = new \DateTime();

    for ($i = 0; $i < 7; $i++) {
        // Format ngày và lấy lịch chiếu
        $dayOfWeek = $currentDate->format('w');
        $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$dayOfWeek];

        // Truy vấn các showtimes theo ngày
        $filteredShowtimes = $showtimes->filter(function ($showtime) use ($currentDate) {
            return $showtime->date == $currentDate->format('Y-m-d') && $showtime->start_time > now();
        })->sortBy('start_time');

        if (!$filteredShowtimes->isEmpty()) {
            // Định dạng lại start_time của các showtimes
            $formattedShowtimes = $filteredShowtimes->map(function ($showtime) {
                // Chuyển đổi start_time thành đối tượng DateTime và định dạng
                $time = new \DateTime($showtime->start_time);
                $showtime->start_time = $time->format('H:i'); // Định dạng HH:MM

                return $showtime; // Trả về showtime đã được cập nhật
            });

            // Thêm vào mảng dates để hiển thị trên view
            $dates[] = [
                'day_id' => 'day' . $currentDate->format('z'),
                'date_label' => $formattedDate,
                'showtimes' => $formattedShowtimes,
            ];
        }

        // Cộng thêm 1 ngày
        $currentDate->add(new \DateInterval('P1D'));
    }

    dd($showtimes->toArray(), $dates);


    // Trả về view với cả showtimes và dates
    return view('client.showtimes', compact('showtimes', 'dates'));
}

}
