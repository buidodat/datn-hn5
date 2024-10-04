<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function index(){
        $cinemas = Cinema::all();
        return view( 'admin.ticket-price', compact('cinemas'));
    }
}
