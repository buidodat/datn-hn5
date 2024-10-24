<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoomRequest;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatTemplate;
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
    {
        $rooms = Room::query()->with(['typeRoom', 'cinema','seats'])->latest('cinema_id')->get();
        $branches = Branch::all();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        $cinemas = Cinema::all();
        $seatTemplates = SeatTemplate::where('is_publish', 1)
            ->where('is_active', 1)
            ->pluck('name', 'id')
            ->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms', 'branches', 'typeRooms', 'cinemas', 'seatTemplates'));
    }


    public function show(Room $room)
    {
        $matrixKey = array_search($room->matrix_id, array_column(Room::MATRIXS, 'id'));
        $matrixSeat = Room::MATRIXS[$matrixKey];
        $seats = Seat::where(['room_id' => $room->id])->get();
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('typeRooms', 'room', 'seats', 'matrixSeat'));
    }

    public function edit(Room $room)
    {
        $matrixSeat = SeatTemplate::getMatrixById($room->seatTemplate->matrix_id);
        $seats = Seat::where(['room_id' => $room->id])->get();
        $seatMap = [];
        foreach ($seats as $seat) {
            $seatMap[$seat->coordinates_y][$seat->coordinates_x] = $seat;
        }
        $typeRooms = TypeRoom::pluck('name', 'id')->all();
        $typeSeats = TypeSeat::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('typeRooms', 'room', 'seatMap', 'matrixSeat', 'typeSeats'));
    }
    public function update(Request $request, Room $room)
    {
        try {
            DB::transaction(function () use ($request, $room) {
                if ($request->action == "publish" && !$room->is_publish) {

                    $room->update([
                        'is_publish' => 1,
                        'is_active' => 1,
                    ]);

                    $dataSeats = $request->seats;

                    $seats = Seat::whereIn('id', array_keys($dataSeats))->get();

                    foreach ($seats as $seat) {
                        $seat->update([
                            'is_active' => $dataSeats[$seat->id],
                        ]);
                    }
                } else {
                    $room->update([
                        'is_active' => isset($request->is_active) ? 1 : 0,
                    ]);
                    $dataSeats = $request->seats;

                    $seats = Seat::whereIn('id', array_keys($dataSeats))->get();

                    foreach ($seats as $seat) {
                        $seat->update([
                            'is_active' => $dataSeats[$seat->id],
                        ]);
                    }
                }
            });


            return redirect()->back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(Room $room)
    {
        try {
            if ($room->is_publish) {
                return redirect()->back()->with('error', 'Đã sảy ra lỗi, vui lòng thử lại sau.');
            }
            DB::transaction(function () use ($room) {

                Seat::where('room_id', $room->id)->delete();
                $room->delete();
            });

            return redirect()->back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


}
