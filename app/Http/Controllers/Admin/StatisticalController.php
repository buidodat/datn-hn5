<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Ticket;
use Carbon\Carbon;


class StatisticalController extends Controller
{
    public function revenue()
    {
        // $revenueByMovies = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
        //     ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
        //     ->groupBy('movies.id', 'movies.name')
        //     ->get();

        $startDate = '2024-11-05';
        $endDate = '2024-11-09';

        $revenueByMovies = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
            ->whereBetween('tickets.created_at', [$startDate, $endDate])
            ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
            ->groupBy('movies.id', 'movies.name')
            ->get();

        return view('admin.statisticals.revenue', compact('revenueByMovies'));
    }


    public function ticketsRevenue(Request $request)
    {
        // Doanh thu tổng quan
        $todayRevenue = Ticket::whereDate('created_at', Carbon::today())->sum('total_price');

        $weekRevenue = Ticket::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_price');

        $monthRevenue = Ticket::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_price');

        $yearRevenue = Ticket::whereYear('created_at', Carbon::now()->year)->sum('total_price');

        // Doanh thu theo ngày trong tháng hiện tại
        $dailyRevenue = Ticket::selectRaw('DATE(created_at) as date, SUM(total_price) as total_price')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Doanh thu theo cơ sở (cinema_id)
        $cinemaRevenue = Ticket::selectRaw('cinema_id, SUM(total_price) as total_price')
            ->groupBy('cinema_id')
            ->get();

        // Lọc
        $query = Ticket::query();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $filteredRevenue = $query->sum('total_price');

        return view('admin.statisticals.ticketsRevenue', compact('todayRevenue', 'weekRevenue', 'monthRevenue', 'yearRevenue', 'dailyRevenue', 'cinemaRevenue','filteredRevenue'));
    }
}
