<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMovieRequest;
use App\Http\Requests\Admin\UpdateMovieRequest;
use App\Models\Movie;
use App\Models\MovieLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.movies.';
    const PATH_UPLOAD = 'movies';
    public function index()
    {
        $movies = Movie::query()->with('movielanguages')->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ratings = Movie::RATINGS;
        $languages = Movie::LANGUAGES;
        return view(self::PATH_VIEW . __FUNCTION__, compact(['ratings', 'languages']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        try {

            DB::transaction(function() use($request){

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
                    'is_active' => isset($request->is_active) ? 1 : 0,
                    'is_hot' => isset($request->is_hot) ? 1 : 0,
                ];


                if ($request->img_thumbnail) {
                    $dataMovie['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
                }

                $movie = Movie::create($dataMovie);

                foreach ($request->languages as $language) {
                    MovieLanguage::create([
                        'movie_id' => $movie->id,
                        'language' => $language
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $movieLanguages = $movie->movielanguages()->pluck('language')->all();
        $ratings = Movie::RATINGS;
        $languages = Movie::LANGUAGES;
        return view(self::PATH_VIEW . __FUNCTION__, compact(['ratings', 'languages', 'movie', 'movieLanguages']));
    }

    /**
     * Update the specified resource in storage.
     */
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
                    'release_date' => $request->release_date,
                    'end_date' => $request->end_date,
                    'trailer_url' => $request->trailer_url,
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

                $movieLanguages = $movie->movieLanguages()->pluck('language')->all();

                foreach ($request->languages as $language) {
                    if (!in_array($language, $movieLanguages)) {
                        MovieLanguage::create([
                            'movie_id' => $movie->id,
                            'language' => $language
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
