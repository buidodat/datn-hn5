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
    // public function show()
    // {
    //     $cinema = Cinema::where('id', session('cinema_id'))->firstOrFail();

    //     // Lấy tất cả các showtimes có cinema_id bằng với ID của cinema
    //     $showtimes = Showtime::with(['movie' => function ($query) {
    //         $query->where('is_active', 1); // Chỉ lấy phim đang active
    //     }, 'room'])
    //         ->where([['cinema_id', $cinema->id], ['is_active', '1']])
    //         ->get();

    //     // Truy vấn lịch chiếu
    //     $dates = [];
    //     $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
    //     $currentDate = now(); // Sử dụng Carbon để làm việc với ngày giờ

    //     // Thời gian thực tế khi truy cập vào trang
    //     $now = now();

    //     for ($i = 0; $i < 7; $i++) {
    //         // Định dạng ngày
    //         $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$currentDate->dayOfWeek];

    //         // Nhóm showtimes theo ngày và phim
    //         $filteredShowtimes = $showtimes->filter(function ($showtime) use ($currentDate) {
    //             // Điều kiện lọc suất chiếu theo ngày
    //             return $showtime->date == $currentDate->format('Y-m-d');
    //         })->groupBy('movie.id'); // Nhóm theo phim

    //         // Chỉ lấy các suất chiếu có start_time sau thời gian thực tế
    //         foreach ($filteredShowtimes as $movieId => $showtimesGroup) {
    //             // Lọc ra những suất chiếu sau thời gian hiện tại
    //             $filteredShowtimes[$movieId] = $showtimesGroup->filter(function ($showtime) use ($now) {
    //                 // Kết hợp `date` và `start_time` để tạo một đối tượng Carbon đầy đủ
    //                 $showtimeDateTime = Carbon::createFromFormat('Y-m-d H:i:s',  $showtime->start_time);

    //                 // Chỉ lấy các suất chiếu có thời gian sau thời gian hiện tại
    //                 return $showtimeDateTime->gt($now);
    //             })->sortBy('start_time'); // Sắp xếp suất chiếu theo thời gian
    //         }

    //         // Kiểm tra nếu vẫn còn suất chiếu thì thêm vào mảng ngày
    //         if ($filteredShowtimes->flatten()->isNotEmpty()) {
    //             $dates[] = [
    //                 'day_id' => 'day' . $currentDate->format('z'),
    //                 'date_label' => $formattedDate,
    //                 'showtimes' => $filteredShowtimes,
    //             ];
    //         }

    //         // Cộng thêm 1 ngày
    //         $currentDate->addDay();
    //     }

    //     return view('client.showtimes', compact('dates', 'cinema')); // Truyền thêm thông tin cinema nếu cần
    // }


    public function show()
    {
        $cinema = Cinema::where('id', session('cinema_id'))->firstOrFail();

        $showtimes = Showtime::with(['movie' => function ($query) {
            $query->where('is_active', 1); // Chỉ lấy phim đang active
        }, 'room'])
            ->where([['cinema_id', $cinema->id], ['is_active', '1']])
            ->get();

        $dates = [];
        $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
        $currentDate = now(); // Sử dụng Carbon để làm việc với ngày giờ
        $now = now(); // Thời gian hiện tại khi truy cập vào trang
        $firstAvailableDay = null; // Biến để lưu ngày đầu tiên có suất chiếu

        for ($i = 0; $i < 7; $i++) {
            $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$currentDate->dayOfWeek];

            $filteredShowtimes = $showtimes->filter(function ($showtime) use ($currentDate) {
                return $showtime->date == $currentDate->format('Y-m-d') && $showtime->movie && $showtime->movie->is_active;
            })->groupBy('movie.id');

            foreach ($filteredShowtimes as $movieId => $showtimesGroup) {
                $filteredShowtimes[$movieId] = $showtimesGroup->filter(function ($showtime) use ($now) {
                    $showtimeDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $showtime->start_time);
                    return $showtimeDateTime->gt($now);
                })->sortBy('start_time');
            }

            if ($filteredShowtimes->flatten()->isNotEmpty()) {
                $dates[] = [
                    'day_id' => 'day' . $currentDate->format('z'),
                    'date_label' => $formattedDate,
                    'showtimes' => $filteredShowtimes,
                ];

                if (!$firstAvailableDay) {
                    $firstAvailableDay = 'day' . $currentDate->format('z');
                }
            }

            $currentDate->addDay();
        }

        return view('client.showtimes', compact('dates', 'cinema', 'firstAvailableDay'));
    }
}
