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
        $showTime = Showtime::findOrFail($id);

        // $d = $showtime->room;
        // $showtime->room->seats;
        // dd($showtime->toArray());

        return view('client.choose-seat', compact('showTime'));
    }
}
