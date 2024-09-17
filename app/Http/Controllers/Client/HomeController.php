<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Slideshow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    // const PATH_VIEW = 'client.';
    // const PATH_UPLOAD = 'home';
    public function home()
    {

        $slideShow = Slideshow::query()->where('is_active', 1)->get();

        $currentNow = now()->format('Y-m-d');

        // phim sắp chiếu
        $moviesUpcoming = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])->latest('id')
            ->get();

        //phim đang chiếu
        $moviesShowing = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '<=', $currentNow],
            ['end_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])->latest('id')
            ->get();

        $moviesSpecial = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['is_special', '1']
        ])->latest('id')
            ->get();


        return view('client.home', compact('moviesUpcoming', 'moviesShowing', 'moviesSpecial', 'currentNow','slideShow'));
    }

    public function policy()
    {
        return view('client.policy');
    }
}
