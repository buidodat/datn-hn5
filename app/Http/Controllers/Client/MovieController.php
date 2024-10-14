<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {


        $currentNow = now();
        $endDate = now()->addDays(7);

        // phim sắp chiếu
        $moviesShowing = Movie::where([
            ['is_active', '1'],
            ['release_date', '<=', $currentNow],
            ['end_date', '>=', $currentNow]
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')->get();

        // Phim sắp chiếu (chưa đến thời gian khởi chiếu)
        $moviesUpcoming = Movie::where([
            ['is_active', '1'],
            ['release_date', '>', $currentNow]
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')->get();

        // Phim suất chiếu đặc biệt (chưa đến ngày khởi chiếu hoặc đã hết thời gian khởi chiếu)
        $moviesSpecial = Movie::where([
            ['is_active', '1'],
            ['is_special', '1']
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->get();

        return view('client.movies', compact('moviesUpcoming', 'moviesShowing', 'moviesSpecial', 'currentNow', 'endDate'));
    }
}