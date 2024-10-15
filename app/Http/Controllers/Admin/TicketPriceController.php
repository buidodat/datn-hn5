<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function index(Request $request)
    {
        $cinemas = Cinema::all();
        $branches = Branch::where('is_active', '1')->get();

        // lỌc
        $cinemasPaginate = Cinema::where('is_active', '1')
            ->latest('branch_id')
            ->when($request->branch_id, function ($query) use ($request) {
                return $query->where('branch_id', $request->branch_id);
            })
            ->paginate(4)
            ->appends($request->all());


        $movies = Movie::where('is_active', '1')->get();


        return view('admin.ticket-price', compact('cinemas', 'cinemasPaginate', 'branches', 'movies'));
    }
}
