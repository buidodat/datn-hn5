<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieDetailController extends Controller
{
    public function show(string $slug){
        $movie = Movie::where('slug',$slug)->firstOrFail();
//        $listBinhLuan = $movie->movieReview;
        $userReviewed = false;
        if (Auth::check()) {
            $review = MovieReview::where('user_id', Auth::id())
                ->where('movie_id', $movie->id)
                ->first();
            if ($review) {
                $userReviewed = true;
            }
        }
        return view('client.movie-detail' , compact('movie','userReviewed'));
    }
    public function getComments($movieId)
    {
        $movie = Movie::findOrFail($movieId);

        $listBinhLuan = $movie->movieReview()->with('user')->get();

        return response()->json($listBinhLuan);
    }
    public function addReview(Request $request, string $slug)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'description' => 'required|string|max:220',
        ]);

        $movie = Movie::where('slug', $slug)->firstOrFail();

        $review = MovieReview::where('user_id', Auth::id())
            ->where('movie_id', $movie->id)
            ->first();
        if ($review) {
            return back()->with('error', 'Bạn không thể chỉnh sửa đánh giá này nữa.');
        }

        MovieReview::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'rating' => $request->input('rating'),
            'description' => $request->input('description'),
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá bộ phim!');
    }

}
