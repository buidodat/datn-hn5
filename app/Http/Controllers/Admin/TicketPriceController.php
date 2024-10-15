<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::all();
        $branches = Branch::where('is_active', '1')->get();
        $cinemasPaginate = Cinema::where('is_active', '1')->paginate('4');
        $movies = Movie::where('is_active', '1')->get();
        return view('admin.ticket-price', compact('cinemas', 'cinemasPaginate', 'branches', 'movies'));
    }
}
