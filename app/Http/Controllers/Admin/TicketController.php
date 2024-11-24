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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.tickets.';

    public function __construct()
    {
        $this->middleware('can:Danh sách hóa đơn')->only('index');
        $this->middleware('can:Thêm hóa đơn')->only(['create', 'store']);
        $this->middleware('can:Sửa hóa đơn')->only(['edit', 'update']);
        $this->middleware('can:Xóa hóa đơn')->only('destroy');
        $this->middleware('can:Quét hóa đơn')->only('scan', 'processScan');
        $this->middleware('can:Xem chi tiết hóa đơn')->only('show');
    }

    public function index(Request $request)
    {
        $tickets = Ticket::with(['user', 'cinema', 'movie', 'room', 'showtime'])
            ->latest('id');
        if (Auth::user()->cinema_id != "") {
            $tickets = $tickets->where('cinema_id', Auth::user()->cinema_id);
        }


        // Lọc theo cinema_id
        if ($request->input('cinema_id')) {
            $tickets = $tickets->whereHas('cinema', function ($query) use ($request) {
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

        $tickets = $tickets->get()->groupBy('code');

        $barcodes = [];
        foreach ($tickets as $code => $group) {
            $barcodes[$code] = DNS1D::getBarcodeHTML($code, 'C128', 1.5, 50);
        }
        $cinemas = Cinema::all();
        $branches = Branch::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('tickets', 'cinemas', 'branches', 'barcodes'));
    }


    /*public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required',
        ]);

        if ($ticket->status == 'Đã xuất vé') {
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
    }*/

    public function confirm(Request $request, Ticket $ticket)
    {
        if ($ticket->status == Ticket::NOT_ISSUED && $ticket->expiry > now()) {
            $ticket->update([
                'status' => Ticket::ISSUED
            ]);
        }
        session()->flash('confirm', true);

        return response()->json([
            'success' => true,
            'message' => 'Thay đổi trạng thái thành công!'
        ]);


    }

    /*public function print(Ticket $ticket)
    {
        $ticket->load([
            'movie.movieVersions',
            'room',
            'ticketCombos.combo.food',
            'ticketSeats.seat.typeSeat',
            'cinema.branch',
            'user'
        ]);

        $viewData = [
            'ticket' => $ticket,
            'barcode' => DNS1D::getBarcodeHTML($ticket->code, 'C128', 1.5, 50),
            'totalPriceSeat' => $this->calculateTotalSeatPrice($ticket),
            'totalComboPrice' => $this->calculateTotalComboPrice($ticket),
            'ratingDescription' => $this->getRatingDescription($ticket->movie->rating)
        ];

        return view(self::PATH_VIEW . 'order', $viewData);
        // Tải về file PDF
    }*/
    /*public function printCombo(Ticket $ticket)
        {
            $oneTicket = Ticket::with(['ticketCombos','cinema.branch'])->findOrFail($ticket->id);
            $barcode = DNS1D::getBarcodeHTML($oneTicket->code, 'C128', 1.5, 50);
            return view(self::PATH_VIEW . __FUNCTION__, compact('ticket','oneTicket','barcode'));
        }*/

    public function scan()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }


    public function processScan(Request $request)
    {
        $ticketCode = $request->input('code');

        $ticket = Ticket::where('code', $ticketCode)->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Mã vé không hợp lệ.',
            ]);
        }

        $now = Carbon::now();
        if ($now > $ticket->expiry) {
            return response()->json([
                'success' => false,
                'message' => 'Vé này đã hết hạn.',
            ]);
        }

        switch ($ticket->status) {
            case 'Chưa xuất vé':
                return response()->json([
                    'success' => true,
                    'message' => 'QR code đã được xử lý thành công!',
                    'redirect_url' => route('admin.tickets.show', $ticket)
                ]);

            case 'Đã xuất vé':
                return response()->json([
                    'success' => true,
                    'message' => 'Vé này đã được suất rồi.',
                    'redirect_url' => route('admin.tickets.show', $ticket)
                ]);

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Vé không hợp lệ.',
                ]);
        }

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
        $oneTicket = $ticket->load(['ticketCombos.combo', 'showtime']);
        $totalPriceSeat = $ticket->ticketSeats->sum('price');
        $totalComboPrice = $ticket->ticketCombos->sum('price');
        $barcode = DNS1D::getBarcodeHTML($ticket->code, 'C128', 1.5, 50);
        return view(self::PATH_VIEW . __FUNCTION__, compact('ticket', 'oneTicket', 'totalPriceSeat', 'barcode', 'totalComboPrice'));
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
