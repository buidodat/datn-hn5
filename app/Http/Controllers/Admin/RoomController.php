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
use Illuminate\Support\Str;

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


    public function show(Room $room)
    {
        $seats = Seat::where(['room_id' => $room->id])->get();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['typeRooms', 'room','seats']));
    }

    public function seatDiagram(Room $room) {
        $matrixKey = array_search($room->matrix_id, array_column(Room::MATRIXS, 'id'));
        $matrixSeat = Room::MATRIXS[$matrixKey];
        $seats = Seat::withTrashed()->where(['room_id' => $room->id])->get();
        $branches = Branch::all();
        $cinemas = Cinema::where('branch_id',$room->branch->id)->get();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        $typeSeats = TypeSeat::pluck('name','id')->all();
        return view(self::PATH_VIEW . 'seat-diagram', compact(['typeRooms', 'branches', 'room','cinemas','seats','matrixSeat','typeSeats']));
    }
    public function publish(Request $request, Room $room)
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


    // public function convertNumberToLetters($number = Room::ROW_SEAT_REGULAR)
    // { // hàm chuyển đổi số thành mangr chữ câis
    //     $letters = [];

    //     for ($i = 0; $i < $number; $i++) {
    //         $letters[] = chr(65 + $i); // 65 là mã ASCII của chữ cái 'A'
    //     }

    //     return $letters;
    // }
}
