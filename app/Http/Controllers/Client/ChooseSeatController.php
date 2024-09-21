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


        $showTime->seats;
        
        // $showTime->room->seats;
        // $showTime->movie;
        // $showTime->movie_version;
        // $showTime->room->cinema;
        dd($showTime->toArray());

        return view('client.choose-seat', compact('showTime'));
    }
}
