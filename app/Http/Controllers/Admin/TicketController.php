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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.tickets.';

    public function index(Request $request)
    {
        // $tickets = Ticket::with(['user', 'ticketSeats.cinema', 'ticketSeats.movie', 'ticketSeats.room', 'ticketSeats.showtime', 'ticketSeats.seat'])
        //     ->orderBy('id')
        //     ->get()
        //     ->groupBy('code');

        $tickets = Ticket::with(['user', 'cinema', 'movie', 'room',  'ticketSeats.showtime'])
            ->latest('created_at');


        // Lọc theo cinema_id
        if ($request->input('cinema_id')) {
            $tickets = $tickets->whereHas('ticketSeats.cinema', function ($query) use ($request) {
                $query->where('id', $request->cinema_id);
            });
        }
        // Lọc theo ngày
        if ($request->input('date')) {
            $date = $request->input('date');
            // lọc theo created_at, vì khác định dạng date vs timestamp
            $tickets = $tickets->whereBetween('created_at', [
                Carbon::parse($date)->startOfDay(),         // 00:00:00 ngày ý
                Carbon::parse($date)->endOfDay()            // 23:59:59 của ngày ý
            ]);
        }

        // Cập nhật trạng thái vé hết hạn
        $now = Carbon::now();
        Ticket::where('expiry', '<', $now)
            ->where('status', '!=', 'Đã hết hạn')
            ->update(['status' => 'Đã hết hạn']);

        $tickets = $tickets->get()->groupBy('code');
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

        if ($ticket->status == 'Đã suất vé') {
            return response()->json([
                'success' => false,
                'message' => 'Vé đã hoàn tất, không thể chỉnh sửa.'
            ]);
        }

        // Tạo biến thời gian hiện tại với múi giờ Asia/Ho_Chi_Minh
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        // Kiểm tra nếu vé đã hết hạn
        if ($ticket->expiry < $now) {
            $ticket->status = 'Đã hết hạn';
            $ticket->save();

            return response()->json([
                'success' => false,
                'message' => 'Vé đã hết hạn và trạng thái đã được cập nhật thành "Đã hết hạn".'
            ]);
        }

        // Nếu vé chưa hết hạn, tiếp tục cập nhật trạng thái theo yêu cầu
        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['success' => true]);
    }

    public function print(Ticket $ticket)
    {
        $oneTicket = Ticket::with(['movie.movieVersions','room','ticketCombos','ticketSeats.seat','cinema.branch'])->findOrFail($ticket->id);
        $users = $ticket->user()->first();
        $totalPriceSeat = $ticket->ticketSeats->sum(function ($ticketSeat) {
            return $ticketSeat->seat->typeSeat->price;
        });
        $barcode = DNS1D::getBarcodeHTML($oneTicket->code, 'C128', 1.5, 50);

        return view(self::PATH_VIEW . __FUNCTION__, compact('ticket','oneTicket','users','totalPriceSeat','barcode'));
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
        $oneTicket = Ticket::with(['movie','room','ticketCombos','ticketSeats.showtime'])->findOrFail($ticket->id);
        $users = $ticket->user()->first();
        $totalPriceSeat = $ticket->ticketSeats->sum(function ($ticketSeat) {
            return $ticketSeat->seat->typeSeat->price;
        });
        // Tạo QR code và barcode dựa trên mã 'code' của vé
        $qrCode = QrCode::size(120)->generate($oneTicket->code);
        return view(self::PATH_VIEW . __FUNCTION__, compact('ticket', 'users', 'oneTicket', 'totalPriceSeat','qrCode'));
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
