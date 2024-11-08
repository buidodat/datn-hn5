<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function revenue()
    {
        // $revenueByMovies = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
        //     ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
        //     ->groupBy('movies.id', 'movies.name')
        //     ->get();

        $startDate = '2024-11-05';
        $endDate = '2024-11-07';

        $revenueByMovies = Ticket::join('movies', 'tickets.movie_id', '=', 'movies.id')
            ->whereBetween('tickets.created_at', [$startDate, $endDate])
            ->select('movies.name', DB::raw('SUM(tickets.total_price) as total_revenue'))
            ->groupBy('movies.id', 'movies.name')
            ->get();

        return view('admin.statisticals.revenue', compact('revenueByMovies'));
    }
}
