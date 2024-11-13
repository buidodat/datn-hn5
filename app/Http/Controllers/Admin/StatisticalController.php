<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
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


    public function statisticalMovies(Request $request)
    {
        $branches = Branch::all();

        // Lấy giá trị mặc định cho start_date và end_date (1 tháng gần nhất)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->startOfDay()->format('Y-m-d\TH:i'));
        $endDate = $request->input('end_date', Carbon::now()->endOfDay()->format('Y-m-d\TH:i'));

        // Khởi tạo query cho doanh thu theo phim
        $query = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
            ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
            ->groupBy('movies.id', 'movies.name');

        // Áp dụng lọc theo chi nhánh nếu có
        if ($request->has('branch_id') && $request->input('branch_id') != '') {
            $cinemaIds = Cinema::where('branch_id', $request->input('branch_id'))->pluck('id');
            $query->whereIn('tickets.cinema_id', $cinemaIds);
        }

        // Áp dụng lọc theo rạp nếu có
        if ($request->has('cinema_id') && $request->input('cinema_id') != '') {
            $query->where('tickets.cinema_id', $request->input('cinema_id'));
        }

        // Áp dụng lọc theo ngày nếu có
        if (
            $request->has('start_date') && $request->has('end_date') &&
            $request->input('start_date') != '' && $request->input('end_date') != ''
        ) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $query->whereBetween('tickets.created_at', [$startDate, $endDate]);
        } else {
            // Nếu không có start_date và end_date, mặc định lấy 1 tháng gần nhất
            $query->whereBetween('tickets.created_at', [$startDate, $endDate]);
        }

        // Lấy kết quả doanh thu theo phim
        $revenueByMovies = $query->get();
        // dd($revenueByMovies->toArray());


        // Thống kê tổng phim
        $totalMovies = $revenueByMovies->count('name');
        // dd($totalMovies);

        // Thống kê tổng doanh thu
        $totalRevenue = $revenueByMovies->sum('total_revenue');
        // dd($totalRevenue);

        return view('admin.statisticals.statistical-movies', compact('revenueByMovies', 'branches', 'startDate', 'endDate', 'totalMovies', 'totalRevenue'));
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

    public function cinemaRevenue()
    {
        $startDate = Carbon::parse('2023-10-01'); // Ngày bắt đầu
        $endDate = Carbon::parse('2024-10-31');   // Ngày kết thúc

        $statistics = Ticket::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('cinema_id, SUM(total_price) as total_revenue, COUNT(id) as total_tickets')
            ->with('cinema:id,name') 
            ->groupBy('cinema_id')
            ->orderBy('total_revenue', 'desc') 
            ->get();


        //THống kê theo rạp 
        $revenueByCinema = Ticket::join('cinemas', 'tickets.cinema_id', '=', 'cinemas.id')
            ->select('cinemas.name as cinema_name', DB::raw('SUM(tickets.total_price) as total_revenue'))
            ->groupBy('cinemas.name')
            ->orderBy('total_revenue', 'desc')
            ->get();

        return view('admin.statisticals.cinemaRevenue', compact('revenueByCinema', 'statistics'));
    }
}
