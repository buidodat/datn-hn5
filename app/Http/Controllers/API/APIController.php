<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MovieVersion;
use App\Models\Room;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class APIController extends Controller
{
    public function getCinemas($branchId)
    {
        $cinemas = Cinema::where('branch_id', $branchId)
            ->where('is_active', '1')
            ->get();
        return response()->json($cinemas);
    }


    public function getRooms($cinemaId)
    {
        $rooms = Room::where('cinema_id', $cinemaId)
            ->where('rooms.is_active', '1')
            ->join('type_rooms', 'type_rooms.id', '=', 'rooms.type_room_id') // Join bảng type_rooms
            ->leftJoin('seats', 'seats.room_id', '=', 'rooms.id') // Join bảng seats để đếm số lượng ghế
            ->select('rooms.*', 'type_rooms.name as type_room_name', DB::raw('COUNT(seats.id) as total_seats')) // Đếm số ghế
            ->groupBy('rooms.id') // Nhóm theo id của rooms để đếm chính xác
            ->get();

        return response()->json($rooms);
    }


    public function getMovieVersion($movieId)
    {
        $movieVersions = MovieVersion::where('movie_id', $movieId)->get();
        return response()->json($movieVersions);
    }
    public function getMovieDuration($movieId)
    {
        $movie = Movie::findOrFail($movieId);
        if ($movie) {
            return response()->json(['duration' => $movie->duration]);
        }
        return response()->json(['error' => 'Không tìm thấy phim'], 404);
    }


    public function getShowtimesByRoom(Request $request)
    {
        $roomId = $request->get('room_id');
        $date = $request->get('date');

        $showtimes = Showtime::with('room')
            ->where('room_id', $roomId)
            ->where('date', $date)
            ->get();

        if ($showtimes->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không có suất chiếu nào cho ngày này.'
            ]);
        }

        foreach ($showtimes as $showtime) {
            $showtime->start_time = Carbon::parse($showtime->start_time)->format('H:i'); // Định dạng HH:mm
            $showtime->end_time = Carbon::parse($showtime->end_time)->format('H:i'); // Định dạng HH:mm
        }

        return response()->json($showtimes);
    }
}
