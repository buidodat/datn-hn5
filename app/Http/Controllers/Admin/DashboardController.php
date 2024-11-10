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

        return view('admin.dashboard', compact('todayRevenue', 'weekRevenue', 'monthRevenue', 'yearRevenue'));
    }
}
