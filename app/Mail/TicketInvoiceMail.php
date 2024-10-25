<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketInvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;
    public $user;
    public $showtime;
    public $seats;
    public $combos;

    public function __construct(Ticket $ticket)
    {
        // Load các mối quan hệ liên quan tới vé
        $this->ticket = $ticket->load(['user','ticketSeats.showtime', 'ticketSeats.seat', 'ticketCombos.combo']);
        // $this->ticket = $ticket->load(['user', 'showtime', 'ticketSeats.seat', 'ticketCombos.combo']);
        $this->user = $this->ticket->user;           // Người dùng đặt vé
        $this->showtime = $this->ticket->ticketSeats->first()->showtime ?? null; // Chọn suất chiếu từ ghế đầu tiên
        $this->seats = $this->ticket->ticketSeats;   // Các ghế đã đặt
        $this->combos = $this->ticket->ticketCombos; // Các combo đã mua
    }

    public function build()
    {
        return $this->view('client.emails.ticket_invoice')
            ->subject('Hóa đơn đặt vé')
            ->with([
                'ticket' => $this->ticket,
                'user' => $this->user,
                'showtime' => $this->showtime,
                'seats' => $this->seats,
                'combos' => $this->combos,
            ]);
    }
}
