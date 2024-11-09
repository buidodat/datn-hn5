<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function cancel(Ticket $ticket){
        try {
            DB::transaction(function() use($ticket){
                if($ticket->status == Ticket::NOT_ISSUED && $ticket->e){

                }
            });
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
