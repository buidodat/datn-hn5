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
use App\Models\SeatTemplate;
use App\Models\Showtime;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        // Giá trị mặc định
        $user = Auth::user();
        if ($user->cinema_id == "") {
            $defaultBranchId = 1;
            $defaultCinemaId = 1;
            $defaultDate = now()->format('Y-m-d');
            $defaultIsActive = null;
        } else {
            $defaultBranchId = $user->cinema->branch_id;
            $defaultCinemaId = $user->cinema_id;
            $defaultDate = now()->format('Y-m-d');
            $defaultIsActive = null;
        }


        // Lấy giá trị từ session hoặc sử dụng mặc định nếu session chưa có
        $branchId = $request->input('branch_id', session('showtime.branch_id', $defaultBranchId));
        $cinemaId = $request->input('cinema_id', session('showtime.cinema_id', $defaultCinemaId));
        $date = $request->input('date', session('showtime.date', $defaultDate));
        $isActive = $request->input('is_active', session('showtime.is_active', $defaultIsActive));

        // Lưu vào session
        session([
            'showtime.branch_id' => $branchId,
            'showtime.cinema_id' => $cinemaId,
            'showtime.date' => $date,
            'showtime.is_active' => $isActive
        ]);

        //Thiếu where is_active
        $branches = Branch::where('is_active', '1')->get();
        $cinemas = Cinema::where('branch_id', $branchId)->where('is_active', '1')->get();

        $showtimesQuery = Showtime::where('cinema_id', $cinemaId)
            ->whereDate('date', $date);

        if ($isActive !== null) {
            $showtimesQuery->where('is_active', $isActive);
        }
        $showtimes = $showtimesQuery->with(['movie', 'room', 'movieVersion'])->latest('id')->get();

        $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        return view(self::PATH_VIEW . __FUNCTION__, compact('showtimes', 'branches', 'cinemas', 'timeNow', 'branchId', 'cinemaId', 'date', 'isActive'));
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

                $dateShowtime = Carbon::parse($request->date);
                if (!$dateShowtime->between($movie->release_date, $movie->end_date)) {
                    // dd('ko nằm trong khoảng này');
                    $movie->is_special = "1";
                    $movie->save();
                }

                if ($request->has('auto_generate_showtimes')) {
                    //
                    $startHour = $request->input('start_hour'); // Giờ mở cửa
                    $endHour = $request->input('end_hour'); // Giờ đóng cửa

                    // if (!$startHour || !$endHour) {
                    //     return back()->with('error', 'Bạn phải nhập Giờ mở cửa và Giờ đóng cửa khi chọn tự động tạo suất chiếu.');
                    // }

                    //
                    $startTime = \Carbon\Carbon::parse($request->date . ' ' . $startHour);
                    $endOfDay = \Carbon\Carbon::parse($request->date . ' ' . $endHour);

                    // Kiểm tra nếu giờ mở cửa hoặc đóng cửa trong quá khứ
                    if ($startTime->isPast() || $endOfDay->isPast()) {
                        return back()->with('error', "Giờ mở cửa và giờ đóng cửa phải nằm trong tương lai.");
                    }

                    // Lặp
                    while ($startTime->lt($endOfDay)) {
                        $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime);

                        // // Kiểm tra nếu suất chiếu trong quá khứ
                        // if ($startTime->isPast()) {
                        //     break; // Dừng tạo suất chiếu
                        // }

                        foreach ($existingShowtimes as $showtime) {
                            if ($startTime->lt($showtime->end_time) && $endTime->gt($showtime->start_time)) {
                                throw new \Exception("Thời gian chiếu bị trùng lặp với suất chiếu khác.");
                            }
                        }

                        $dataShowtimes = [
                            'cinema_id' => $request->cinema_id ?? $user->cinema_id,
                            'room_id' => $request->room_id,
                            'slug' => Showtime::generateCustomRandomString(),
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
                    if (empty($request->start_time)) {
                        return back()->with('error', 'Bạn phải nhập ít nhất một Giờ chiếu khi thêm suất chiếu thủ công.');
                    }
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
                            'slug' => Showtime::generateCustomRandomString(),
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

            session()->flash('success', 'Thêm mới thành công!');
            return response()->json(['success' => true, 'message' => 'Thêm mới thành công!']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }


    public function show(Showtime $showtime)
    {
        //dd($showtime);
        $showtime->load(['room.cinema', 'room.seatTemplate', 'movieVersion', 'movie', 'seats']);

        $matrix = SeatTemplate::getMatrixById($showtime->room->seatTemplate->matrix_id);
        //dd($matrix);
        $seats =  $showtime->seats;

        $soldSeats = $showtime->seats()->wherePivot('status', 'sold')->pluck('seats.id')->toArray();

        return view(self::PATH_VIEW . __FUNCTION__, compact('showtime', 'matrix', 'seats', 'soldSeats'));
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

        $movieDuration = $showtime->movie->duration;


        $cleaningTime = Showtime::CLEANINGTIME;
        return view(self::PATH_VIEW . __FUNCTION__, compact('movies', 'rooms', 'movieVersions', 'cinemas', 'cleaningTime', 'branches', 'showtime', 'movieDuration'));
    }

    public function update(UpdateShowtimeRequest $request, Showtime $showtime)
    {

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
