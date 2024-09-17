<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MovieVersion;
use App\Models\Room;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getCinemas($branchId)
    {
        $cinemas = Cinema::where('branch_id', $branchId)->get();
        return response()->json($cinemas);
    }

    public function getRooms($movieId)
    {
        $rooms = Room::where('cinema_id', $movieId)->get();
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
}
