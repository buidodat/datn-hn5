<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMovieRequest;
use App\Http\Requests\Admin\UpdateMovieRequest;

use App\Models\Movie;
use App\Models\MovieVersion;
use App\Models\TypeRoom;
use App\Models\TypeSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{

    const PATH_VIEW = 'admin.movies.';
    const PATH_UPLOAD = 'movies';
    public function __construct()
    {
        $this->middleware('can:Danh sách phim')->only('index');
        $this->middleware('can:Thêm phim')->only(['create', 'store']);
        $this->middleware('can:Sửa phim')->only(['edit', 'update']);
        $this->middleware('can:Xóa phim')->only('destroy');
    }

    public function index()
    {
        $movies = Movie::query()->with('movieVersions')->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies'));
    }


    public function create()
    {
        $ratings = Movie::RATINGS;
        $versions = Movie::VERSIONS;
        // $typeSeats = TypeSeat::all();
        // $typeRooms = TypeRoom::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['ratings', 'versions', ]));
    }


    public function store(StoreMovieRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $dataMovie = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'category' => $request->category,
                    'description' => $request->description,
                    'director' => $request->director,
                    'cast' => $request->cast,
                    'rating' => $request->rating,
                    'duration' => $request->duration,
                    'release_date' => $request->release_date,
                    'end_date' => $request->end_date,
                    'trailer_url' => $request->trailer_url,
                    'surcharge' => $request->surcharge,
                    'is_active' => isset($request->is_active) ? 1 : 0,
                    'is_hot' => isset($request->is_hot) ? 1 : 0,
                ];


                if ($request->img_thumbnail) {
                    $dataMovie['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
                }

                $movie = Movie::create($dataMovie);

                foreach ($request->versions as $version) {
                    MovieVersion::create([
                        'movie_id' => $movie->id,
                        'name' => $version
                    ]);
                }
            });

            return redirect()
                ->route('admin.movies.index')
                ->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function show(Movie $movie)
    {
        $movieVersions = $movie->movieVersions()->pluck('name')->all();
        $ratings = Movie::RATINGS;
        $versions = Movie::VERSIONS;
        $movieReviews = $movie->movieReview()->get();
        $totalReviews = $movieReviews->count();
        $averageRating = $totalReviews > 0 ? $movieReviews->avg('rating') : 0;
        $starCounts = [];
        for ($i = 1; $i <= 10; $i++) {
            $starCounts[$i] = $movieReviews->where('rating', $i)->count();
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact(['ratings', 'versions', 'movie', 'movieVersions', 'movieReviews', 'totalReviews', 'averageRating', 'starCounts']));
    }

    public function edit(Movie $movie)
    {

        $movieVersions = $movie->movieVersions()->pluck('name')->all();
        $ratings = Movie::RATINGS;
        $versions = Movie::VERSIONS;
        // $typeSeats = TypeSeat::all();
        // $typeRooms = TypeRoom::all();


        return view(self::PATH_VIEW . __FUNCTION__, compact('ratings', 'versions', 'movie', 'movieVersions'));
    }
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        try {
            DB::transaction(function () use ($request, $movie) {
                $dataMovie = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'category' => $request->category,
                    'description' => $request->description,
                    'director' => $request->director,
                    'cast' => $request->cast,
                    'rating' => $request->rating,
                    'duration' => $request->duration,
                    'end_date' => $request->end_date,
                    'trailer_url' => $request->trailer_url,
                    'surcharge' => $request->surcharge,
                    'is_active' => isset($request->is_active) ? 1 : 0,
                    'is_hot' => isset($request->is_hot) ? 1 : 0,
                ];


                if ($request->img_thumbnail) {
                    $dataMovie['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
                    // Lưu lại đường dẫn của ảnh hiện tại để so sánh sau
                    $ImgThumbnailCurrent = $movie->img_thumbnail;
                } else {
                    // Nếu không có ảnh mới, giữ nguyên ảnh cũ
                    unset($dataMovie['img_thumbnail']);
                }

                $movie->update($dataMovie);

                // Nếu có ảnh mới và ảnh mới khác với ảnh cũ, xóa ảnh cũ khỏi hệ thống
                if (!empty($ImgThumbnailCurrent) && ($dataMovie['img_thumbnail'] ?? null) != $ImgThumbnailCurrent && Storage::exists($ImgThumbnailCurrent)) {
                    Storage::delete($ImgThumbnailCurrent);
                }

                $movieVersions = $movie->movieVersions()->pluck('name')->all();

                foreach ($request->versions ?? [] as $version) {
                    if (!in_array($version, $movieVersions)) {
                        MovieVersion::create([
                            'movie_id' => $movie->id,
                            'name' => $version
                        ]);
                    }
                }
            });

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
