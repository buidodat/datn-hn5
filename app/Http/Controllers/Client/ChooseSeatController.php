<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ChooseSeatController extends Controller
{
    public function show(string $id)
    {
        $showtime = Showtime::findOrFail($id);
        // $showtime = Showtime::with(['seats'])->findOrFail($id);

        // $showtime->room->seats;
        // $showtime->movie;
        // $showtime->movieVersion;
        // $showtime->room->cinema;
        // dd($showtime->toArray());

        return view('client.choose-seat', compact('showtime'));
    }
}
