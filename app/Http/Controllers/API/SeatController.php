<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

}
