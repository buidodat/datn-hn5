<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {

        $user = Auth::user();
        // Tổng doanh thu ngày hôm nay
        $todayRevenue = Ticket::whereDate('created_at', Carbon::today())->sum('total_price');

        // Doanh thu của một ngày cụ thể
        // $specificDayRevenue = Ticket::whereDate('created_at', '2024-11-07') // Ví dụ
        //     ->sum('total_price');

        // Tổng doanh thu tuần này
        $weekRevenue = Ticket::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_price');

        // Tổng doanh thu tháng này
        $monthRevenue = Ticket::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        // Tổng doanh thu năm nay
        $yearRevenue = Ticket::whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        // return view(self::PATH_VIEW . __FUNCTION__);


        // doanh thu theo phim
        $startDate = '2024-05-01';
        $endDate = '2024-11-30';

        //doanh thu theo khung giờ chiếu
        $timeSlots = [
            ['start' => '09:00:00', 'end' => '13:00:00', 'label' => '9:00 - 13:00'],
            ['start' => '13:00:00', 'end' => '18:00:00', 'label' => '13:00 - 18:00'],
            ['start' => '18:00:00', 'end' => '24:00:00', 'label' => '18:00 - 24:00'],
        ];

        $revenueTimeSlot = [];
        foreach ($timeSlots as $slot) {
            $totalRevenue = Ticket::join('showtimes', 'tickets.showtime_id', '=', 'showtimes.id')
                ->whereBetween('tickets.created_at', [$startDate, $endDate])
                ->whereTime('showtimes.start_time', '>=', $slot['start'])
                ->whereTime('showtimes.start_time', '<', $slot['end'])
                ->sum('tickets.total_price');

            $revenueTimeSlot[] = [
                'label' => $slot['label'],
                'revenue' => (float)$totalRevenue, // Chuyển sang kiểu số thực
            ];
        }

        // dd($revenueByMovies);

        return view('admin.dashboard', compact('todayRevenue', 'weekRevenue', 'monthRevenue', 'yearRevenue', 'revenueTimeSlot'));
    }
}
