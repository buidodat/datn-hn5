<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cinema;
use App\Models\TypeRoom;
use App\Models\TypeSeat;

class TicketPriceController extends Controller
{
    public function index(Request $request)
    {
        // $typeRooms = TypeRoom::all();

        // Lọc $typeRooms chỉ lấy 3D và IMAX
        $typeRooms = TypeRoom::whereIn('name', ['3D', 'IMAX'])->get();
        
        $typeSeats = TypeSeat::all();

        $cinemasPaginate = Cinema::where('is_active', '1')
            ->latest('branch_id')
            ->when($request->branch_id, function ($query) use ($request) {
                return $query->where('branch_id', $request->branch_id);
            })
            ->get();

        $cinemaId = session('cinema_id') ?? $request->input('cinema_id');
        $cinema = Cinema::with('branch')->find($cinemaId);
        return view('client.ticket-price', compact('typeRooms','typeSeats','cinemasPaginate','cinema'));
    }
}