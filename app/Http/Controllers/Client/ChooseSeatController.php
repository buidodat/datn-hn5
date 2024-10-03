<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ChooseSeatController extends Controller
{
    public function show(string $id)
    {
        // $showtime = Showtime::findOrFail($id);
        // // $showtime = Showtime::with(['seats'])->findOrFail($id);

        // $showtime->room->seats;
        // $showtime->movie;
        // $showtime->movieVersion;
        // $showtime->room->cinema;
        // dd($showtime->toArray());

        $showtime = Showtime::with(['room.cinema', 'room', 'movieVersion', 'movie'])->findOrFail($id);
        $showtime->room->seats;
        $matrixKey = array_search($showtime->room->matrix_id, array_column(Room::MATRIXS, 'id'));
        $matrixSeat = Room::MATRIXS[$matrixKey];
        // $seats = Seat::withTrashed()->where('room_id', $showtime->room->id)->get();

        // dd($showtime->toArray());
        return view('client.choose-seat', compact('showtime', 'matrixSeat'));
    }

    public function test(Request $request, $showtimeId)
    {
        // dd($request->all());

        // Lưu thông tin vào session
        session([
            'showtime_id' => $request->input('showtimeId'),
            'seat_ids' => explode(',', $request->input('seatId')), // Chuyển chuỗi ghế thành mảng
            'selected_seats' => explode(', ', $request->input('selected_seats')), // Chuyển tên ghế thành mảng
            'total_price_seat' => $request->input('total_price_seat'),
        ]);

        return redirect()->route('checkout');
    }
}
