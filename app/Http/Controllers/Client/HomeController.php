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

        // phim sắp chiếu
        $moviesUpcoming = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])->latest('id')
            ->paginate(8);

        //phim đang chiếu
        $moviesShowing = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '<=', $currentNow],
            ['end_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])->latest('id')
            ->paginate(8);

        $moviesSpecial = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['is_special', '1']
        ])->latest('id')
            ->paginate(8);


        return view('client.home', compact('moviesUpcoming', 'moviesShowing', 'moviesSpecial', 'currentNow'));
    }
}
