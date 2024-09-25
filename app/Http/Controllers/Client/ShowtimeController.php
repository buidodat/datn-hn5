<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon để xử lý ngày tháng

class ShowtimeController extends Controller
{
    public function showWeekDays()
    {
        $days = collect(); // Tạo một collection để lưu trữ các ngày

        // Vòng lặp để lấy 7 ngày liên tiếp
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i); // Lấy ngày hôm nay và cộng thêm số ngày tương ứng
            $days->push([
                'date' => $date->format('d/m'),  // Lấy định dạng ngày/tháng
                'weekday' => $date->isoFormat('ddd'),  // Lấy định dạng thứ (T2, T3,...)
            ]);
        }

        // dd($days);

        // Trả dữ liệu về view 'showtimes.weekdays' với biến 'days'
        return view('client.showtimes', compact('days'));
    }
}
