<?php

namespace App\Http\Controllers\Client;

use App\Events\SeatRelease;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\SeatHold;
use App\Jobs\ReleaseSeatHoldJob;
use Exception;

class ChooseSeatController extends Controller
{
    public function show(string $id)
    {
        // dd(session()->all());

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

    public function saveInformation(Request $request, $showtimeId)
    {
        // dd($request->all());
        // dd(session()->all());

        // Xác thực dữ liệu đầu vào
        // $request->validate([
        //     'showtimeId' => 'required|integer|exists:showtimes,id',
        //     'seatId' => 'required|string', // Chuỗi chứa các ID ghế
        //     'selected_seats' => 'required|string', // Chuỗi chứa các tên ghế đã chọn
        //     'total_price_seat' => 'required|numeric', // Tổng giá tiền cho các ghế đã chọn
        // ]);
        // Lưu thông tin vào session
        session([
            'showtime_id' => $request->input('showtimeId'),
            'seat_ids' => explode(',', $request->input('seatId')), // Chuyển chuỗi ghế thành mảng
            'selected_seats' => explode(', ', $request->input('selected_seats')), // Chuyển tên ghế thành mảng
            'total_price' => $request->input('total_price'),
        ]);
        // dd(session()->all());

        return redirect()->route('checkout');
    }

    public function holdSeats(Request $request)
    {
        $seatIds = $request->seat_ids; // Nhận mảng ID ghế
        $showtimeId = $request->showtime_id;
        $userId = auth()->id(); // Lấy ID người dùng đang đăng nhập

        try {
            DB::transaction(function () use ($seatIds, $showtimeId, $userId) {
                foreach ($seatIds as $seatId) {
                    // Sử dụng lockForUpdate để tránh xung đột
                    $seatShowtime = DB::table('seat_showtimes')
                        ->where('seat_id', $seatId)
                        ->where('showtime_id', $showtimeId)
                        ->lockForUpdate()
                        ->first();

                    if ($seatShowtime && $seatShowtime->status == 'available') {
                        // Cập nhật trạng thái ghế và thông tin người giữ ghế
                        DB::table('seat_showtimes')
                            ->where('seat_id', $seatId)
                            ->where('showtime_id', $showtimeId)
                            ->update([
                                'status' => 'hold',
                                'user_id' => $userId, // Gán người dùng đang giữ ghế
                                'hold_expires_at' => now()->addMinutes(1) // Giữ ghế trong 10 phút
                            ]);

                        // Phát sự kiện Pusher để thông báo ghế được giữ
                        event(new SeatHold($seatId, $showtimeId));
                    }
                }

                // Dispatch Job để giải phóng ghế sau 10 phút
                ReleaseSeatHoldJob::dispatch($seatIds, $showtimeId)->delay(now()->addMinutes(1));
            });

            return response()->json(['message' => 'Trạng thái ghế đã được cập nhật thành công.'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi, rollback transaction nếu có lỗi
            return response()->json([
                'message' => 'Có lỗi xảy ra khi giữ ghế.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function releaseSeats(Request $request)
    {
        $seatIds = $request->input('seat_ids');
        $showtimeId = $request->input('showtime_id');

        DB::transaction(function () use ($seatIds, $showtimeId) {
            foreach ($seatIds as $seatId) {
                DB::table('seat_showtimes')
                    ->where('seat_id', $seatId)
                    ->where('showtime_id', $showtimeId)
                    ->update([
                        'status' => 'available',
                        'user_id' => null,
                        'hold_expires_at' => null
                    ]);

                // Phát sự kiện Pusher
                event(new SeatRelease($seatId, $showtimeId));
            }
        });

        return response()->json(['message' => 'Ghế đã được giải phóng.'], 200);
    }
}
