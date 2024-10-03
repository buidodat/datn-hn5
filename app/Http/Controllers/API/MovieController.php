<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function getShowtimes(Movie $movie)
    {


        // Truy vấn lịch chiếu
        $dates = [];
        $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];

        // Lấy ngày hiện tại
        $currentDate = new \DateTime();

        for ($i = 0; $i < 7; $i++) {
            // Format ngày và lấy lịch chiếu
            $dayOfWeek = $currentDate->format('w');
            $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$dayOfWeek];
            $showtimes = DB::table('showtimes')
                ->where('showtimes.movie_id', $movie->id)
                ->where('showtimes.cinema_id', session('cinema_id')) // Lọc trực tiếp theo cinema_id trong bảng showtimes
                ->whereDate('showtimes.date', $currentDate)
                ->where('showtimes.start_time', '>', now())
                ->orderBy('showtimes.start_time', 'asc')
                ->select('showtimes.*') // Lấy tất cả các trường từ bảng showtimes
                ->get();
            $showtimeFormats  = [];
            foreach ($showtimes as $showtime) {
                if (!isset($showtimeFormats[$showtime->format])) {
                    $showtimeFormats[$showtime->format] = [];
                }
                // Nếu phim chưa có trong mảng của định dạng, thêm vào
                if (!in_array($showtime, $showtimeFormats[$showtime->format])) {
                    $showtimeFormats[$showtime->format][] = $showtime;
                }
            }

            if (!$showtimes->isEmpty()) {
                // $formattedShowtimes = $showtimes->map(function ($showtime) {
                //     // Chuyển đổi start_time thành đối tượng DateTime và định dạng
                //     $time = new \DateTime($showtime->start_time);
                //     $showtime->start_time = $time->format('H:i'); // Định dạng HH:MM

                //     return $showtime; // Trả về showtime đã được cập nhật
                // });

                $dates[] = [
                    'day_id' => 'day' . $currentDate->format('z'),
                    'date_label' => $formattedDate,
                    'showtimes' => $showtimeFormats,
                ];
            }
            // Cộng thêm 1 ngày
            $currentDate->add(new \DateInterval('P1D'));
        }
    //    foreach ($dates as $date) {

    //            foreach ($date['showtimes'] as $key => $showtime) {
    //                 dd($key);
    //            }

    //    }
        return response()->json(['dates' => $dates, 'movie' => $movie]);
    }
}

// <?php

// namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
// use App\Models\Movie;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class MovieController extends Controller
// {
//     public function getShowtimes(Movie $movie)
//     {


//         // Truy vấn lịch chiếu
//         $dates = [];
//         $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];

//         // Lấy ngày hiện tại
//         $currentDate = new \DateTime();

//         for ($i = 0; $i < 7; $i++) {
//             // Format ngày và lấy lịch chiếu
//             $dayOfWeek = $currentDate->format('w');
//             $formattedDate = $currentDate->format('d/m') . ' - ' . $dayNames[$dayOfWeek];
//             $showtimes = DB::table('showtimes')
//                 ->join('rooms', 'showtimes.room_id', '=', 'rooms.id') // Join với bảng rooms
//                 ->where('showtimes.movie_id', $movie->id)
//                 ->where('rooms.cinema_id', session('cinema_id')) // Lọc theo cinema_id trong bảng rooms
//                 ->whereDate('showtimes.date', $currentDate)
//                 ->where('showtimes.start_time', '>', now())
//                 ->orderBy('showtimes.start_time', 'asc')
//                 ->select('showtimes.*') // Lấy tất cả các trường từ bảng showtimes
//                 ->get();


//             if (!$showtimes->isEmpty()) {
//             $formattedShowtimes = $showtimes->map(function ($showtime) {
//                 // Chuyển đổi start_time thành đối tượng DateTime và định dạng
//                 $time = new \DateTime($showtime->start_time);
//                 $showtime->start_time = $time->format('H:i'); // Định dạng HH:MM

//                 return $showtime; // Trả về showtime đã được cập nhật
//             });

//             $dates[] = [
//                 'day_id' => 'day' . $currentDate->format('z'),
//                 'date_label' => $formattedDate,
//                 'showtimes' => $formattedShowtimes,
//             ];
//         }
//             // Cộng thêm 1 ngày
//             $currentDate->add(new \DateInterval('P1D'));
//         }

//         return response()->json(['dates' => $dates,'movie'=>$movie]);
//     }
// }

