<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MovieVersion;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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


    // public function getTypeRooms($typeRoomId)
    // {
    //     $rooms = Room::where('type_room_id', $typeRoomId)->get();
    //     return response()->json($rooms);
    // }

}
