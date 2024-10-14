<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::all();
        $cinemasPaginate = Cinema::where('is_active', '1')->paginate('4');
        return view('admin.ticket-price', compact('cinemas', 'cinemasPaginate'));
    }
}
