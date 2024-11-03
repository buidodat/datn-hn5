<?php

namespace App\Mail;

use DNS1D;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Milon\Barcode\Facades\DNS1DFacade;

class TicketInvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;
    public $user;
    public $showtime;
    public $seats;
    public $combos;
    public $barcodeBase64;

    public function __construct(Ticket $ticket)
    {
        // Load các mối quan hệ liên quan tới vé
        $this->ticket = $ticket->load(['user','ticketSeats.showtime', 'ticketSeats.seat', 'ticketCombos.combo']);
        // $this->ticket = $ticket->load(['user', 'showtime', 'ticketSeats.seat', 'ticketCombos.combo']);
        $this->user = $this->ticket->user;           // Người dùng đặt vé
        $this->showtime = $this->ticket->ticketSeats->first()->showtime ?? null; // Chọn suất chiếu từ ghế đầu tiên
        $this->seats = $this->ticket->ticketSeats;   // Các ghế đã đặt
        $this->combos = $this->ticket->ticketCombos; // Các combo đã mua

         // Tạo mã vạch dưới dạng base64
         $this->barcodeBase64 = 'data:image/png;base64,' . base64_encode(DNS1DFacade::getBarcodePNG($this->ticket['code'], 'C128'));
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
                'barcodeBase64' => $this->barcodeBase64, // Truyền barcodeBase64 vào view
            ]);
    }
}
