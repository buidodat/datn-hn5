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
                ->where('movie_id', $movie->id)
                ->whereDate('date', $currentDate)
                ->where('start_time', '>', now())
                ->orderBy('start_time', 'asc')
                ->get();

             if (!$showtimes->isEmpty()) {
            $formattedShowtimes = $showtimes->map(function ($showtime) {
                // Chuyển đổi start_time thành đối tượng DateTime và định dạng
                $time = new \DateTime($showtime->start_time);
                $showtime->start_time = $time->format('H:i'); // Định dạng HH:MM

                return $showtime; // Trả về showtime đã được cập nhật
            });

            $dates[] = [
                'day_id' => 'day' . $currentDate->format('z'),
                'date_label' => $formattedDate,
                'showtimes' => $formattedShowtimes,
            ];
        }

            // Cộng thêm 1 ngày
            $currentDate->add(new \DateInterval('P1D'));
        }
// dd( $dates);

        return response()->json(['dates' => $dates,'movie'=>$movie]);
    }
}
