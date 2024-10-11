<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Ticket;
use App\Models\TicketSeat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.tickets.';

    public function index()
    {
        $tickets = Ticket::with(['user', 'ticketSeats.cinema', 'ticketSeats.movie', 'ticketSeats.room', 'ticketSeats.showtime','ticketSeats.seat'])
            ->orderBy('id')
            ->get()
            ->groupBy('code');

        //định dạng expiry để so sánh
        foreach ($tickets as $key => $group) {
            foreach ($group as $ticket) {
                $ticket->expiry = Carbon::parse($ticket->expiry);
            }
        }


        $cinemas = Cinema::all();
        $branches = Branch::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('tickets', 'cinemas', 'branches'));
    }


    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $oneTicket = Ticket::with(['ticketSeats.movie'])->findOrFail($ticket->id);
        $users = $ticket->user()->first();
        $totalPriceSeat = $ticket->ticketSeats->sum(function ($ticketSeat) {
            return $ticketSeat->seat->typeSeat->price;
        });

        return view(self::PATH_VIEW . __FUNCTION__, compact('ticket','users','oneTicket','totalPriceSeat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
