<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Slideshow;
use App\Models\Post;
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
        ])
            ->with('showtimes')
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        //phim đang chiếu
        $moviesShowing = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '<=', $currentNow],
            ['end_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])
            ->with('showtimes')
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        $moviesSpecial = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['is_special', '1']
        ])
            ->with('showtimes')
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        // $post = Post::latest()->take(5)->get();
        $post = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('client.home', compact('moviesUpcoming', 'moviesShowing', 'moviesSpecial', 'slideShow', 'post'));
    }

    public function policy()
    {
        return view('client.policy');
    }

    public function loadMoreMovies2(Request $request)
    {
        $currentNow = now()->format('Y-m-d');

        // Lấy phim theo trang
        $moviesShowing = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '<=', $currentNow],
            ['end_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')->paginate(8);

        // Trả về view chứa thêm các phim (chỉ phần HTML của phim)
        return view('client.layouts.components.movie-list2', compact('moviesShowing'))->render();
    }

    public function loadMoreMovies1(Request $request)
    {
        $currentNow = now()->format('Y-m-d');

        // Lấy phim theo trang
        $moviesUpcoming = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['release_date', '>', $currentNow],
            ['is_special', '!=', '1']
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        // Trả về view chứa thêm các phim (chỉ phần HTML của phim)
        return view('client.layouts.components.movie-list1', compact('moviesUpcoming'))->render();
    }

    public function loadMoreMovies3(Request $request)
    {
        $currentNow = now()->format('Y-m-d');

        // Lấy phim theo trang
        $moviesSpecial = Movie::where([
            ['is_active', '1'],
            ['is_show_home', '1'],
            ['is_special', '1']
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        // Trả về view chứa thêm các phim (chỉ phần HTML của phim)
        return view('client.layouts.components.movie-list3', compact('moviesSpecial'))->render();
    }

    public function getShowtimes($movieId)
    {
        $showtimes = Showtime::with(['room.cinema', 'movieVersion', 'movie'])
            ->where('movie_id', $movieId)
            ->where('is_active', '1')
            ->get();

        return response()->json($showtimes);
    }
}
