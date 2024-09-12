<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    // const PATH_VIEW = 'client.';
    // const PATH_UPLOAD = 'home';
    public function home()
    {
        $currentNow = now()->format('Y-m-d');

        $movies = Movie::where('is_active', '1')
            ->where('is_show_home', '1')
            ->latest('id')
            ->get();
        // dd($movies);
        return view('client.home', compact('movies', 'currentNow'));
    }
}
