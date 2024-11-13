<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Ticket;
use Carbon\Carbon;


class StatisticalController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Danh sách thống kê')->only('revenue');
    }

    // public function revenue()
    // {
    //     $branches = Branch::all();


    //     // doanh thu theo phim
    //     $startDate = '2023-11-01';
    //     $endDate = '2024-11-30';

    //     $revenueByMovies = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
    //         ->whereBetween('tickets.created_at', [$startDate, $endDate])
    //         ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
    //         ->groupBy('movies.id', 'movies.name')
    //         ->get();

    //     //doanh thu theo khung giờ chiếu
    //     $timeSlots = [
    //         ['start' => '09:00:00', 'end' => '13:00:00', 'label' => '9:00 - 13:00'],
    //         ['start' => '13:00:00', 'end' => '18:00:00', 'label' => '13:00 - 18:00'],
    //         ['start' => '18:00:00', 'end' => '24:00:00', 'label' => '18:00 - 24:00'],
    //     ];

    //     $revenueTimeSlot = [];
    //     foreach ($timeSlots as $slot) {
    //         $totalRevenue = Ticket::join('showtimes', 'tickets.showtime_id', '=', 'showtimes.id')
    //             ->whereBetween('tickets.created_at', [$startDate, $endDate])
    //             ->whereTime('showtimes.start_time', '>=', $slot['start'])
    //             ->whereTime('showtimes.start_time', '<', $slot['end'])
    //             ->sum('tickets.total_price');

    //         $revenueTimeSlot[] = [
    //             'label' => $slot['label'],
    //             'revenue' => (float)$totalRevenue, // Chuyển sang kiểu số thực
    //         ];
    //     }

    //     // dd($revenueByMovies);


    //     // Thống kê doanh thu theo Ngày/Tháng/Năm
    //     $dailyRevenue = Ticket::selectRaw("DATE(created_at) as date, SUM(total_price) as total_revenue")
    //         ->groupBy('date')->orderBy('date', 'asc')->get();
    //     $weeklyRevenue = Ticket::selectRaw("WEEK(created_at) as week, SUM(total_price) as total_revenue")
    //         ->groupBy('week')->orderBy('week', 'asc')->get();
    //     $monthlyRevenue = Ticket::selectRaw("MONTH(created_at) as month, SUM(total_price) as total_revenue")
    //         ->groupBy('month')->orderBy('month', 'asc')->get();
    //     $yearlyRevenue = Ticket::selectRaw("YEAR(created_at) as year, SUM(total_price) as total_revenue")
    //         ->groupBy('year')->orderBy('year', 'asc')->get();

    //     //THống kê theo rạp 
    //     $revenueByCinema = Ticket::join('cinemas', 'tickets.cinema_id', '=', 'cinemas.id')
    //         ->select('cinemas.name as cinema_name', DB::raw('SUM(tickets.total_price) as total_revenue'))
    //         ->groupBy('cinemas.name')
    //         ->orderBy('total_revenue', 'desc')
    //         ->get();

    //     return view('admin.statisticals.revenue', compact('revenueByMovies', 'branches', 'dailyRevenue', 'weeklyRevenue', 'monthlyRevenue', 'yearlyRevenue', 'revenueByCinema', 'revenueTimeSlot'));
    // }


    public function statisticalRevenue()
    {

        $branches = Branch::all();

        // Thống kê doanh thu theo Ngày/Tháng/Năm
        $dailyRevenue = Ticket::selectRaw("DATE(created_at) as date, SUM(total_price) as total_revenue")
            ->groupBy('date')->orderBy('date', 'asc')->get();
        $weeklyRevenue = Ticket::selectRaw("WEEK(created_at) as week, SUM(total_price) as total_revenue")
            ->groupBy('week')->orderBy('week', 'asc')->get();
        $monthlyRevenue = Ticket::selectRaw("MONTH(created_at) as month, SUM(total_price) as total_revenue")
            ->groupBy('month')->orderBy('month', 'asc')->get();
        $yearlyRevenue = Ticket::selectRaw("YEAR(created_at) as year, SUM(total_price) as total_revenue")
            ->groupBy('year')->orderBy('year', 'asc')->get();


        return view('admin.statisticals.statistical-revenue', compact('branches', 'dailyRevenue', 'weeklyRevenue', 'monthlyRevenue', 'yearlyRevenue'));
    }


    public function statisticalCinemas()
    {

        $branches = Branch::all();

        //THống kê theo rạp 
        $revenueByCinema = Ticket::join('cinemas', 'tickets.cinema_id', '=', 'cinemas.id')
            ->select('cinemas.name as cinema_name', DB::raw('SUM(tickets.total_price) as total_revenue'))
            ->groupBy('cinemas.name')
            ->orderBy('total_revenue', 'desc')
            ->get();


        return view('admin.statisticals.statistical-cinemas', compact('branches', 'revenueByCinema'));
    }


    public function statisticalMovies()
    {

        $branches = Branch::all();

        // doanh thu theo phim
        $startDate = '2023-11-01';
        $endDate = '2024-11-30';

        $revenueByMovies = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
            ->whereBetween('tickets.created_at', [$startDate, $endDate])
            ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
            ->groupBy('movies.id', 'movies.name')
            ->get();

        return view('admin.statisticals.statistical-movies', compact('revenueByMovies', 'branches'));
    }

    public function statisticalTickets()
    {

        $branches = Branch::all();

        // doanh thu theo phim
        $startDate = '2023-11-01';
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

        return view('admin.statisticals.statistical-tickets', compact('revenueTimeSlot', 'branches'));
    }
}
