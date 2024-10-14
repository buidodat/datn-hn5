<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{

    public function softDelete(Request $request)
    {
        $seat = Seat::find($request->seat_id);

        if ($seat) {
            // Xóa mềm ghế (soft delete)
            $seat->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }


    public function restore(Request $request)
    {
        $seat = Seat::withTrashed()->find($request->seat_id);

        if ($seat) {
            // Khôi phục ghế đã bị xóa mềm
            $seat->restore();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }



    public function softDeleteRow(Request $request)
    {
        $row = $request->row;
        Seat::where('coordinates_y', $row)
            ->where('room_id', $request->room_id)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Ghế đã được xóa mềm.']);
    }




    public function restoreRow(Request $request)
    {
        $row = $request->row;
        Seat::withTrashed()
            ->where('coordinates_y', $row)
            ->where('room_id', $request->room_id)
            ->restore();

        return response()->json(
            [
                'success' => true,
                'message' => 'Ghế đã được khôi phục.'
            ]
        );
    }


    
    public function updateSeatType(Request $request)
    {
        $row = $request->row;
        $typeSeatId = $request->type_seat_id;
        $room = Room::findOrFail($request->room_id);
        //khôi phục lại tất cả ghế trên hàng đó
        Seat::withTrashed()
            ->where('coordinates_y', $row)
            ->restore();

        Seat::where('coordinates_y', $row)
            ->where('room_id', $room->id)
            ->update(['type_seat_id' => $typeSeatId]);

        // Trả về phản hồi JSON để xác nhận việc cập nhật thành công
        return response()->json(
            [
                'success' => true,
                'message' => 'ập nhật loại ghế thành công'
            ]
        );
    }
}
