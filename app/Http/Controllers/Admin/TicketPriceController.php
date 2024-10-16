<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\TypeRoom;
use App\Models\TypeSeat;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function index(Request $request)
    {

        $typeRooms = TypeRoom::all();
        $typeSeats = TypeSeat::all();

        $branches = Branch::where('is_active', '1')->get();

        // lỌc
        $cinemasPaginate = Cinema::where('is_active', '1')
            ->latest('branch_id')
            ->when($request->branch_id, function ($query) use ($request) {
                return $query->where('branch_id', $request->branch_id);
            })
            ->paginate(6)
            ->appends($request->all());

        return view('admin.ticket-price', compact('typeRooms', 'typeSeats', 'cinemasPaginate', 'branches'));
    }

    public function update(Request $request)
    {
        // Cập nhật giá vé theo loại ghế
        if ($request->has('seats')) {
            foreach ($request->seats as $seatId => $price) {
                // Tìm và cập nhật giá của ghế dựa trên ID
                $seat = TypeSeat::find($seatId);
                if ($seat) {
                    $seat->price = $price;
                    $seat->save();
                }
            }
        }

        // Cập nhật giá vé theo loại phòng
        if ($request->has('rooms')) {
            foreach ($request->rooms as $roomId => $surcharge) {
                // Tìm và cập nhật giá phòng dựa trên ID
                $room = TypeRoom::find($roomId);
                if ($room) {
                    $room->surcharge = $surcharge;
                    $room->save();
                }
            }
        }

        // Cập nhật giá vé theo rạp
        if ($request->has('cinemas')) {
            foreach ($request->cinemas as $cinemaId => $surcharge) {
                // Tìm và cập nhật giá vé rạp dựa trên ID
                $cinema = Cinema::find($cinemaId);
                if ($cinema) {
                    $cinema->surcharge = $surcharge;
                    $cinema->save();
                }
            }
        }

        // Chuyển hướng lại trang và hiển thị thông báo thành công
        return redirect()->route('admin.ticket-price')->with('success', 'Cập nhật giá vé thành công!');
    }
}
