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
use App\Models\Seat;
use App\Models\SeatShowtime;
use App\Models\Showtime;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.showtimes.';
    const PATH_UPLOAD = 'showtimes';

    // public function index(Request $request)
    // {
    //     //
    //     // $cinemas = Cinema::all();
    //     $branches = Branch::all();

    //     $showtimes = Showtime::with(['room.cinema', 'movieVersion.movie'])->latest('id');

    //     if ($request->input('cinema_id')) {
    //         $showtimes = $showtimes->whereHas('room.cinema', function ($query) use ($request) {
    //             $query->where('id', $request->cinema_id);
    //         });

    //     }

    //     if ($request->input('date')) {
    //         $showtimes = $showtimes->where('date', $request->date);
    //     }

    //     $showtimes = $showtimes->get();

    //     return view(self::PATH_VIEW . __FUNCTION__, compact('showtimes', 'branches'));
    // }

    public function index(Request $request)
    {
        // Lấy ds chi nhánh
        $branches = Branch::all();

        // Lấy ds các phòng
        $rooms = Room::whereHas('showtimes', function ($query) use ($request) {

            if ($request->input('cinema_id')) {
                // Lọc theo rạp 
                $query->whereHas('cinema', function ($cinemaQuery) use ($request) {
                    $cinemaQuery->where('id', $request->cinema_id);
                });
            }

            if ($request->input('date')) {
                // Lọc theo ngày chiếu 
                $query->where('date', $request->date);
            }
        })->with(['cinema', 'showtimes.movieVersion.movie'])
            ->latest('id')
            ->paginate(1); //mỗi trang hiển thị 1 phòng

        //Lưu đường dẫn url khi lọc để đến đc trang 2
        $rooms->appends([
            'cinema_id' => $request->cinema_id,
            'date' => $request->date
        ]);

        $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        // dd();

        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms', 'branches', 'timeNow'));
    }




    public function create()
    {
        //

        $movies = Movie::where('is_active', '1')->get();
        $typeRooms = TypeRoom::all();
        $branches = Branch::where('is_active', '1')->get();

        $cleaningTime = Showtime::CLEANINGTIME;
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies', 'typeRooms', 'cleaningTime', 'branches'));
    }


    //Lưu thêm bảng seat_showtime thì nhớ dùng Transaction
    public function store(StoreShowtimeRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {
                $movieVersion = MovieVersion::find($request->movie_version_id);
                $room = Room::find($request->room_id);
                $typeRoom = TypeRoom::find($room->type_room_id);
                $movie = Movie::find($request->movie_id);
                $movieDuration = $movie ? $movie->duration : 0;
                $cleaningTime = Showtime::CLEANINGTIME;

                //Lặp qua tất cả start-time
                foreach ($request->start_time as $i => $startTimeChild) {
                    $startTime = \Carbon\Carbon::parse($request->date . ' ' . $startTimeChild);
                    $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

                    $dataShowtimes = [
                        'cinema_id' => $request->cinema_id,
                        'room_id' => $request->room_id,
                        'format' => $typeRoom->name . ' ' . $movieVersion->name,
                        'movie_version_id' => $request->movie_version_id,
                        'movie_id' => $request->movie_id,
                        'date' => $request->date,
                        'start_time' => $startTime->format('Y-m-d H:i'), // Định dạng start_time
                        'end_time' => $endTime->format('Y-m-d H:i'), // Định dạng end_time
                        'is_active' => isset($request->is_active) ? 1 : 0,
                    ];

                    $showtime = Showtime::create($dataShowtimes);

                    $seats = Seat::where('room_id', $room->id)->get(); // Lấy tất cả ghế trong phòng

                    foreach ($seats as $seat) {

                        $dataSeatShowtime = [
                            'showtime_id' => $showtime->id,
                            'seat_id' => $seat->id,
                            'status' => 'available'
                        ];

                        SeatShowtime::create($dataSeatShowtime);
                    }
                }
            });

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
        $showtime = Showtime::with(['room.cinema', 'room', 'movieVersion', 'movie', 'seats'])->findOrFail($id);

        $matrixKey = array_search($showtime->room->matrix_id, array_column(Room::MATRIXS, 'id'));
        $matrixSeat = Room::MATRIXS[$matrixKey];
        $seats = Seat::withTrashed()->where('room_id', $showtime->room->id)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('showtime', 'matrixSeat', 'seats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Showtime $showtime)
    {
        //

        $showtimes = Showtime::with(['room', 'movieVersion'])->get();

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

            $movieVersion = MovieVersion::find($request->movie_version_id);
            $room = Room::find($request->room_id);
            $typeRoom = TypeRoom::find($room->type_room_id);
            $movie = Movie::find($request->movie_id);
            $movieDuration = $movie ? $movie->duration : 0;
            $cleaningTime = Showtime::CLEANINGTIME;


            $startTime = \Carbon\Carbon::parse($request->date . ' ' . $request->start_time);
            $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

            $dataShowtimes = [
                'cinema_id' => $request->cinema_id,
                'room_id' => $request->room_id,
                'format' => $typeRoom->name . ' ' . $movieVersion->name,
                'movie_version_id' => $request->movie_version_id,
                'movie_id' => $request->movie_id,
                'date' => $request->date,
                'start_time' => $startTime->format('Y-m-d H:i'), // Định dạng start_time
                'end_time' => $endTime->format('Y-m-d H:i'), // Định dạng end_time
                'is_active' => isset($request->is_active) ? 1 : 0,
            ];



            $showtime->update($dataShowtimes);


            // $seats = Seat::where('room_id', $room->id)->get(); // Lấy tất cả ghế trong phòng

            // foreach ($seats as $seat) {

            //     $dataSeatShowtime = [
            //         'showtime_id' => $showtime->id,
            //         'seat_id' => $seat->id,
            //         'status' => 'available'
            //     ];

            //     SeatShowtime::where('id', $seat->id)->update($dataSeatShowtime);
            // }


            return redirect()
                ->route('admin.showtimes.index')
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
