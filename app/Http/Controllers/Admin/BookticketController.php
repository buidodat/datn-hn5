<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatTemplate;
use App\Models\Showtime;
use App\Models\TypeRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookticketController extends Controller
{
    const PATH_VIEW = 'admin.book-tickets.';

    public function index()
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh');

        $showtimes = Showtime::with('movie')
            ->where('is_active', 1)
            ->whereDate('date', '>=', $now->toDateString())
            ->where('start_time', '>', $now)
            ->orderBy('start_time', 'asc')
            ->get();

        $dayNames = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
        $groupedShowtimes = [];

        // Nhóm suất chiếu theo ngày
        foreach ($showtimes as $showtime) {
            $date = Carbon::parse($showtime->date);
            $formattedDate = $date->format('d/m') . ' - ' . $dayNames[$date->dayOfWeek];
            $dateId = $date->format('z');

            // Tạo cấu trúc dữ liệu nếu chưa tồn tại
            if (!isset($groupedShowtimes[$formattedDate])) {
                $groupedShowtimes[$formattedDate] = [
                    'date_label' => $formattedDate,
                    'date_id' => $dateId,
                    'movies' => [],
                ];
            }

            $movieId = $showtime->movie->id;
            $format = $showtime->format;

            // Tìm kiếm phim trong danh sách
            if (!isset($groupedShowtimes[$formattedDate]['movies'][$movieId])) {
                $groupedShowtimes[$formattedDate]['movies'][$movieId] = [
                    'movie' => $showtime->movie,
                    'showtime_formats' => [],
                ];
            }

            // Thêm showtime vào showtime_formats
            if (!isset($groupedShowtimes[$formattedDate]['movies'][$movieId]['showtime_formats'][$format])) {
                $groupedShowtimes[$formattedDate]['movies'][$movieId]['showtime_formats'][$format] = [
                    'showtimes' => [],
                ];
            }

            // Thêm đối tượng showtime vào showtimes
            $groupedShowtimes[$formattedDate]['movies'][$movieId]['showtime_formats'][$format]['showtimes'][] = $showtime;
        }
        $cinemas = Cinema::all();
        $branches = Branch::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('groupedShowtimes', 'cinemas', 'branches'));
    }
    public function show(Showtime $showtime)
    {
        $seatTemplate = SeatTemplate::first();
        $room = Room::first();
        $matrix = SeatTemplate::getMatrixById($seatTemplate->matrix_id);


        // Giải mã dữ liệu ghế từ trường seat_structure
        $seats = json_decode($seatTemplate->seat_structure, true);


        $totalSeats = 0; // Khởi tạo biến tổng số ghế


        $seatMap = [];
        if ($seats) {
            foreach ($seats as $seat) {
                $coordinates_y = $seat['coordinates_y'];
                $coordinates_x = $seat['coordinates_x'];

                if (!isset($seatMap[$coordinates_y])) {
                    $seatMap[$coordinates_y] = [];
                }

                $seatMap[$coordinates_y][$coordinates_x] = $seat['type_seat_id'];

                // Tăng tổng số ghế
                if ($seat['type_seat_id'] == 3) {
                    // Ghế đôi, cộng thêm 2
                    $totalSeats += 2;
                } else {
                    // Ghế thường hoặc ghế VIP, cộng thêm 1
                    $totalSeats++;
                }
            }
        }
        $seats = Seat::where(['room_id' => $room->id])->get();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('seatMap', 'typeRooms', 'room', 'seats', 'matrix'));
    }
}
