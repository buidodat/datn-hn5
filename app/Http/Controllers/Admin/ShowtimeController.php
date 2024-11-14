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
    public function __construct()
    {
        $this->middleware('can:Danh sách suất chiếu')->only('index');
        $this->middleware('can:Thêm suất chiếu')->only(['create', 'store']);
        $this->middleware('can:Sửa suất chiếu')->only(['edit', 'update']);
        $this->middleware('can:Xóa suất chiếu')->only('destroy');
        $this->middleware('can:Xem chi tiết suất chiếu')->only('show');
    }

    public function index(Request $request)
    {
       

        // $showtimes = Showtime::with(['room.cinema', 'movieVersion.movie'])->latest('id');
        // if ($user->cinema_id != "") {
        //     $showtimes = $showtimes->whereHas('room.cinema', function ($query) use ($user) {
        //         $query->where('id', $user->cinema_id);
        //     });
        // }
        // if ($request->input('cinema_id')) {
        //     $showtimes = $showtimes->whereHas('room.cinema', function ($query) use ($request) {
        //         $query->where('id', $request->cinema_id);
        //     });
        // }

        // if ($request->input('date')) {
        //     $showtimes = $showtimes->where('date', $request->date);
        // }

        // $showtimes = $showtimes->paginate(15);

        // $showtimes->appends([
        //     'cinema_id' => $request->cinema_id,
        //     'date' => $request->date
        // ]);

        $branches = Branch::all();
        $user = auth()->user();
       
        $defaultBranchId = 1;
        $defaultCinemaId = 1;
        $defaultDate = now()->format('Y-m-d');

        $branchId = $request->input('branch_id', $defaultBranchId);
        $cinemaId = $request->input('cinema_id', $defaultCinemaId);
        $date = $request->input('date', $defaultDate);

        // Tải danh sách chi nhánh và rạp
        $cinemas = Cinema::where('branch_id', $branchId)->get();


        $showtimes = Showtime::where('cinema_id', $cinemaId)
            ->whereDate('date', $date)
            ->with(['movie', 'room', 'movieVersion'])
            ->latest('id')
            ->get();

        $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        return view(self::PATH_VIEW . __FUNCTION__, compact('showtimes', 'branches', 'cinemas', 'timeNow', 'branchId', 'cinemaId', 'date'));
    }



    public function create()
    {

        $movies = Movie::where('is_active', '1')->get();
        $typeRooms = TypeRoom::all();
        $branches = Branch::where('is_active', '1')->get();
        $user = auth()->user();

        $rooms = Room::with('typeRoom', 'seats')->where('is_active', '1')->where('cinema_id', $user->cinema_id)->get();


        $cleaningTime = Showtime::CLEANINGTIME;
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies', 'typeRooms', 'cleaningTime', 'branches', 'rooms'));
    }


    // public function store(StoreShowtimeRequest $request)
    // {
    //     try {
    //         DB::transaction(function () use ($request) {
    //             $movieVersion = MovieVersion::find($request->movie_version_id);
    //             $room = Room::find($request->room_id);
    //             $typeRoom = TypeRoom::find($room->type_room_id);
    //             $movie = Movie::find($request->movie_id);
    //             $movieDuration = $movie ? $movie->duration : 0;
    //             $cleaningTime = Showtime::CLEANINGTIME;
    //             $user = auth()->user();

    //             //lấy suất chiếu đang có theo room, date
    //             $existingShowtimes = Showtime::where('room_id', $request->room_id)
    //                 ->where('date', $request->date)
    //                 ->get();

    //             // lặp qua tất cả start-time
    //             foreach ($request->start_time as $i => $startTimeChild) {
    //                 $startTime = \Carbon\Carbon::parse($request->date . ' ' . $startTimeChild);
    //                 $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

    //                 // kiểm tra tg chiếu 
    //                 foreach ($existingShowtimes as $showtime) {
    //                     if ($startTime < $showtime->end_time && $endTime > $showtime->start_time) {
    //                         throw new \Exception("Thời gian chiếu bị trùng lặp với suất chiếu khác.");
    //                     }
    //                 }

    //                 $dataShowtimes = [
    //                     'cinema_id' => isset($request->cinema_id) ? $request->cinema_id : $user->cinema_id,
    //                     'room_id' => $request->room_id,
    //                     'format' => $typeRoom->name . ' ' . $movieVersion->name,
    //                     'movie_version_id' => $request->movie_version_id,
    //                     'movie_id' => $request->movie_id,
    //                     'date' => $request->date,
    //                     'start_time' => $startTime->format('Y-m-d H:i'),
    //                     'end_time' => $endTime->format('Y-m-d H:i'),
    //                     'is_active' => isset($request->is_active) ? 1 : 0,
    //                 ];

    //                 $showtime = Showtime::create($dataShowtimes);


    //                 $seats = Seat::where('room_id', $room->id)->get();

    //                 $seatShowtimes = [];
    //                 foreach ($seats as $seat) {

    //                     $cinemaPrice = $room->cinema->surcharge;
    //                     $moviePrice = $movie->surcharge;
    //                     $typeRoomPrice = $typeRoom->surcharge;
    //                     $typeSeat = $seat->typeSeat->price;

    //                     // dd($cinemaPrice . '-' . $moviePrice  . '-' . $typeRoomPrice  . '-' . $typeSeat);

    //                     $price = $cinemaPrice + $moviePrice + $typeRoomPrice + $typeSeat;
    //                     if ($seat->is_active == 0) {
    //                         $status = 'broken';
    //                     } else {
    //                         $status = 'available';
    //                     }

    //                     $seatShowtimes[] = [
    //                         'showtime_id' => $showtime->id,
    //                         'seat_id' => $seat->id,
    //                         'status' => $status,
    //                         'price' => $price
    //                     ];
    //                 }


    //                 SeatShowtime::insert($seatShowtimes);
    //             }
    //         });

    //         return redirect()
    //             ->route('admin.showtimes.index')
    //             ->with('success', 'Thêm mới thành công!');
    //     } catch (\Throwable $th) {
    //         return back()->with('error', $th->getMessage());
    //     }
    // }

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
                $user = auth()->user();

                // Lấy các suất chiếu hiện có trong phòng và ngày được chọn
                $existingShowtimes = Showtime::where('room_id', $request->room_id)
                    ->where('date', $request->date)
                    ->get();


                if ($request->has('auto_generate_showtimes')) {
                    // 
                    $startHour = $request->input('start_hour'); // Giờ mở cửa
                    $endHour = $request->input('end_hour'); // Giờ đóng cửa

                    //
                    $startTime = \Carbon\Carbon::parse($request->date . ' ' . $startHour);
                    $endOfDay = \Carbon\Carbon::parse($request->date . ' ' . $endHour);

                    // Lặp 
                    while ($startTime->lt($endOfDay)) {
                        $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

                        foreach ($existingShowtimes as $showtime) {
                            if ($startTime->lt($showtime->end_time) && $endTime->gt($showtime->start_time)) {
                                throw new \Exception("Thời gian chiếu bị trùng lặp với suất chiếu khác.");
                            }
                        }

                        $dataShowtimes = [
                            'cinema_id' => $request->cinema_id ?? $user->cinema_id,
                            'room_id' => $request->room_id,
                            'format' => $typeRoom->name . ' ' . $movieVersion->name,
                            'movie_version_id' => $request->movie_version_id,
                            'movie_id' => $request->movie_id,
                            'date' => $request->date,
                            'start_time' => $startTime->format('Y-m-d H:i'),
                            'end_time' => $endTime->format('Y-m-d H:i'),
                            'is_active' => $request->has('is_active') ? 1 : 0,
                        ];

                        $showtime = Showtime::create($dataShowtimes);


                        $seats = Seat::where('room_id', $room->id)->get();
                        $seatShowtimes = [];
                        foreach ($seats as $seat) {
                            $cinemaPrice = $room->cinema->surcharge;
                            $moviePrice = $movie->surcharge;
                            $typeRoomPrice = $typeRoom->surcharge;
                            $typeSeat = $seat->typeSeat->price;

                            $price = $cinemaPrice + $moviePrice + $typeRoomPrice + $typeSeat;
                            $status = $seat->is_active == 0 ? 'broken' : 'available';

                            $seatShowtimes[] = [
                                'showtime_id' => $showtime->id,
                                'seat_id' => $seat->id,
                                'status' => $status,
                                'price' => $price
                            ];
                        }

                        SeatShowtime::insert($seatShowtimes);

                        //startTime suất chiếu mới
                        $startTime = $endTime;

                        // Làm tròn startTime đến số đẹp chia hết cho 5
                        $minute = $startTime->minute;
                        $roundedMinute = ceil($minute / 5) * 5;
                        $startTime->minute($roundedMinute)->second(0);

                        // Nếu làm tròn phút vượt quá 59, tăng giờ và đặt phút về 00
                        if ($roundedMinute >= 60) {
                            $startTime->addHour()->minute(0);
                        }
                    }
                } else {
                    // Thêm suất chiếu theo cách thủ công
                    foreach ($request->start_time as $i => $startTimeChild) {
                        $startTime = \Carbon\Carbon::parse($request->date . ' ' . $startTimeChild);
                        $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

                        foreach ($existingShowtimes as $showtime) {
                            if ($startTime->lt($showtime->end_time) && $endTime->gt($showtime->start_time)) {
                                throw new \Exception("Thời gian chiếu bị trùng lặp với suất chiếu khác.");
                            }
                        }

                        $dataShowtimes = [
                            'cinema_id' => $request->cinema_id ?? $user->cinema_id,
                            'room_id' => $request->room_id,
                            'format' => $typeRoom->name . ' ' . $movieVersion->name,
                            'movie_version_id' => $request->movie_version_id,
                            'movie_id' => $request->movie_id,
                            'date' => $request->date,
                            'start_time' => $startTime->format('Y-m-d H:i'),
                            'end_time' => $endTime->format('Y-m-d H:i'),
                            'is_active' => $request->has('is_active') ? 1 : 0,
                        ];

                        $showtime = Showtime::create($dataShowtimes);

                        $seats = Seat::where('room_id', $room->id)->get();
                        $seatShowtimes = [];
                        foreach ($seats as $seat) {
                            $cinemaPrice = $room->cinema->surcharge;
                            $moviePrice = $movie->surcharge;
                            $typeRoomPrice = $typeRoom->surcharge;
                            $typeSeat = $seat->typeSeat->price;

                            $price = $cinemaPrice + $moviePrice + $typeRoomPrice + $typeSeat;
                            $status = $seat->is_active == 0 ? 'broken' : 'available';

                            $seatShowtimes[] = [
                                'showtime_id' => $showtime->id,
                                'seat_id' => $seat->id,
                                'status' => $status,
                                'price' => $price
                            ];
                        }
                        SeatShowtime::insert($seatShowtimes);
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
        $user = auth()->user();
        if ($user->cinema_id == "") {
            $rooms = Room::where('is_active', '1')->with(['cinema'])->first('id')->get();
        } else {
            $rooms = Room::with('typeRoom', 'seats')->where('is_active', '1')->where('cinema_id', $user->cinema_id)->get();
        }
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
            $user = auth()->user();

            $startTime = \Carbon\Carbon::parse($request->date . ' ' . $request->start_time);
            $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

            $dataShowtimes = [
                'cinema_id' => isset($request->cinema_id) ? $request->cinema_id : $user->cinema_id,
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
