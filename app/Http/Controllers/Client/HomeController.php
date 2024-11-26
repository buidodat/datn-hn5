<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Slideshow;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    //
    // const PATH_VIEW = 'client.';
    // const PATH_UPLOAD = 'home';


    public function home()
    {
        // Lấy tất cả các slideshow
        $slideShow = Slideshow::query()->where('is_active', 1)->get();

        // Kiểm tra nếu img_thumbnail là một chuỗi JSON, chuyển đổi về mảng
        foreach ($slideShow as $slide) {
            // Kiểm tra nếu img_thumbnail có dữ liệu
            if ($slide->img_thumbnail) {
                $images = json_decode($slide->img_thumbnail);
                if (is_array($images) && count($images) > 0) {
                    $slide->img_thumbnail = $images;
                }
            }
        }

        $currentNow = now();
        $endDate = now()->addDays(7);

        // phim sắp chiếu
        $moviesShowing = Movie::where([
            ['is_active', '1'],
            ['release_date', '<=', $currentNow],
            ['end_date', '>=', $currentNow]
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        // Phim sắp chiếu (chưa đến thời gian khởi chiếu)
        $moviesUpcoming = Movie::where([
            ['is_active', '1'],
            ['release_date', '>', $currentNow]
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);

        // Phim suất chiếu đặc biệt (chưa đến ngày khởi chiếu hoặc đã hết thời gian khởi chiếu)
        $moviesSpecial = Movie::where([
            ['is_active', '1'],
            ['is_special', '1']
        ])
            ->orderBy('is_hot', 'desc')
            ->latest('id')
            ->paginate(8);


        $posts = Post::where('is_active', 1)->orderBy('created_at', 'desc')->take(5)->get();

        return view('client.home', compact('moviesUpcoming', 'moviesShowing', 'moviesSpecial', 'slideShow', 'posts', 'currentNow', 'endDate'));
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
