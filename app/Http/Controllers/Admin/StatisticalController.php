<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.statistical.';
    const PATH_UPLOAD = 'statistical';
    public function index()
    {
        //
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

        return view(self::PATH_VIEW . __FUNCTION__, compact('todayRevenue', 'weekRevenue', 'monthRevenue', 'yearRevenue'));
    }

    /**
     * Show the form for creating a new r   esource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
