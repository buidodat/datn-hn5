<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoomRequest;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\Seat;
use App\Models\TypeRoom;
use App\Models\TypeSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    const PATH_VIEW = 'admin.rooms.';
    const PATH_UPLOAD = 'rooms';
    public function index()
    {   $roomPublishs = Room::query()->with(['typeRoom', 'cinema'])->where('is_publish',true)->latest('id')->get();
        $roomDrafts = Room::query()->with(['typeRoom', 'cinema'])->where('is_publish',false)->latest('id')->get();
        $rooms = Room::query()->with(['typeRoom', 'cinema'])->latest('cinema_id')->get();
        $branches = Branch::all();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        $cinemas = Cinema::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms','branches','typeRooms','roomPublishs','roomDrafts','cinemas'));
    }

    // public function create()
    // {
    //     $capacities = Room::CAPACITIESS;
    //     $branches = Branch::where('is_active',1)->pluck('name', 'id')->all();
    //     $cinemas = Cinema::pluck('name', 'id')->all();
    //     $typeRooms = TypeRoom::pluck('name', 'id')->all();
    //     return view(self::PATH_VIEW . __FUNCTION__, compact(['typeRooms', 'capacities', 'branches', 'cinemas']));
    // }

    // public function store(StoreRoomRequest $request)
    // {

    //     // try {
    //     DB::transaction(function () use ($request) {

    //         $dataRoom = [
    //             'branch_id' =>$request->branch_id,
    //             'cinema_id' => $request->cinema_id,
    //             'type_room_id' => $request->type_room_id,
    //             'name' => $request->name,
    //             'capacity' => 225,
    //             'is_active' => isset($request->is_active) ? 1 : 0,
    //         ];

    //         $room =  Room::create($dataRoom);


    //         $rowSeatRegular = $this->convertNumberToLetters();

    //         foreach ($request->seatJsons as $seat) { // duyệt mảng json

    //             $seat = json_decode($seat, true); // chuyển đổi json thành mẩng

    //             $seat['room_id'] = $room->id;
    //             $seat['name'] = $seat['coordinates_y'].$seat['coordinates_x'];

    //             if (in_array($seat['coordinates_y'], $rowSeatRegular)) { // logic gắn thêm loại ghế vào $seat
    //                 $seat['type_seat_id'] = 1;
    //             } else {
    //                 $seat['type_seat_id'] = 2;
    //             }

    //             Seat::create($seat);
    //         }
    //     });


    //     return redirect()
    //         ->route('admin.rooms.index')
    //         ->with('success', 'Thêm mới thành công!');
    //     // } catch (\Throwable $th) {
    //     //     return back()->with('error', $th->getMessage());
    //     // }
    // }

    public function show(Room $room)
    {
        $seats = Seat::where(['room_id' => $room->id])->get();
        $capacities = Room::CAPACITIESS;
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['typeRooms', 'capacities', 'room','seats']));
    }


    public function edit(Room $room) {
        $matrixKey = array_search($room->matrix_id, array_column(Room::MATRIXS, 'id'));
        $matrixSeat = Room::MATRIXS[$matrixKey];
        $seats = Seat::withTrashed()->where(['room_id' => $room->id])->get();
        $branches = Branch::all();
        $cinemas = Cinema::where('branch_id',$room->branch->id)->get();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        $typeSeats = TypeSeat::pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['typeRooms', 'branches', 'room','cinemas','seats','matrixSeat','typeSeats']));
    }
    public function update(Request $request, Room $room)
    {
        try {
            $room->update([
                'is_publish' =>1,
                'is_active'=>1,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function changeActive(Request $request, Room $room)
    {
        try {
            $room->update([
                'is_active'=>$request->is_active ?? 0
            ]);
            return redirect()
                ->back()
                ->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function convertNumberToLetters($number = Room::ROW_SEAT_REGULAR)
    { // hàm chuyển đổi số thành mangr chữ câis
        $letters = [];

        for ($i = 0; $i < $number; $i++) {
            $letters[] = chr(65 + $i); // 65 là mã ASCII của chữ cái 'A'
        }

        return $letters;
    }
}
