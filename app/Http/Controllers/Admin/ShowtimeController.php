<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShowtimeRequest;
use App\Http\Requests\Admin\UpdateShowtimeRequest;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MovieVersion;
use App\Models\Room;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.showtimes.';
    const PATH_UPLOAD = 'showtimes';
    public function index()
    {
        //
        $showtimes = Showtime::with(['room', 'movie_version'])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('showtimes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $movies = Movie::where('is_active', '1')->get();
        $rooms = Room::where('is_active', '1')->with(['cinema'])->first('id')->get();

        $movieVersions = MovieVersion::all();
        $cinemas = Cinema::where('is_active', '1')->with(['branch'])->first('id')->get();
        $branches = Branch::where('is_active', '1')->get();

        $cleaningTime = Showtime::CLEANINGTIME;
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies', 'rooms', 'movieVersions', 'cinemas', 'cleaningTime', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShowtimeRequest $request)
    {
        //
        try {
            $dataShowtimes = [
                'room_id' => $request->room_id,
                'movie_version_id' => $request->movie_version_id,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'is_active' => isset($request->is_active) ? 1 : 0,
            ];

            // dd($request->all());

            Showtime::create($dataShowtimes);


            return redirect()
                ->route('admin.showtimes.index')
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
    public function edit(Showtime $showtime)
    {
        //

        $showtimes = Showtime::with(['room', 'movie_version'])->get();

        $movies = Movie::where('is_active', '1')->get();
        $rooms = Room::where('is_active', '1')->with(['cinema'])->first('id')->get();

        $movieVersions = MovieVersion::all();
        $cinemas = Cinema::where('is_active', '1')->with(['branch'])->first('id')->get();
        $branches = Branch::where('is_active', '1')->get();

        $cleaningTime = Showtime::CLEANINGTIME;
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies', 'rooms', 'movieVersions', 'cinemas', 'cleaningTime', 'branches', 'showtime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShowtimeRequest $request, Showtime $showtime)
    {
        //
        try {
            $dataShowtimes = [
                'room_id' => $request->room_id,
                'movie_version_id' => $request->movie_version_id,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'is_active' => isset($request->is_active) ? 1 : 0,
            ];

            // dd($request->all());

            $showtime->update($dataShowtimes);

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
    public function destroy(Showtime $showtime)
    {
        //
        try {
            //code...
            $showtime->delete();

            return redirect()
                ->route('admin.showtimes.index')
                ->with('success', 'Xóa thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
