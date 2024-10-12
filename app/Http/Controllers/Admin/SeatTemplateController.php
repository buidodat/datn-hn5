<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeatTemplate;
use Illuminate\Http\Request;

class SeatTemplateController extends Controller
{
    const PATH_VIEW = 'admin.seat-templates.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seatTemplates = SeatTemplate::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('seatTemplates'));
    }

    // public function create()
    // {
    //     $branches = Branch::where('is_active', 1)->pluck('name', 'id')->all();
    //     return view(self::PATH_VIEW . __FUNCTION__, compact('branches'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreCinemaRequest $request)
    // {
    //     try {
    //         $data = $request->all();
    //         $data['is_active'] ??= 0;

    //         Cinema::query()->create($data);

    //         return redirect()
    //             ->route('admin.cinemas.index')
    //             ->with('success', 'Thêm thành công!');
    //     } catch (\Throwable $th) {
    //         return back()->with('error', $th->getMessage());
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(SeatTemplate $seatTemplate)
    {
        // Lấy cấu trúc ma trận từ hằng số MATRIXS
        $matrix = SeatTemplate::getMatrixById($seatTemplate->id);

        // Giải mã dữ liệu ghế từ trường seat_structure
        $seats = json_decode($seatTemplate->seat_structure, true);
        $seatMap = [];

        // Đếm tổng số ghế
        $totalSeats = 0; // Khởi tạo biến tổng số ghế

        if ($seats) {
            foreach ($seats as $seat) {
                $coordinates_y = $seat['coordinates_y'];
                $coordinates_x = $seat['coordinates_x'];

                if (!isset($seatMap[$coordinates_y])) {
                    $seatMap[$coordinates_y] = [];
                }

                $seatMap[$coordinates_y][$coordinates_x] = $seat['type_seat_id'];

                // Tăng tổng số ghế
                if ($seat['type_seat_id'] == 3) {
                    // Ghế đôi, cộng thêm 2
                    $totalSeats += 2;
                } else {
                    // Ghế thường hoặc ghế VIP, cộng thêm 1
                    $totalSeats++;
                }
            }
        }

        // Trả về view với matrix, seats và tổng số ghế
        return view(self::PATH_VIEW . __FUNCTION__, compact('matrix', 'seatTemplate', 'seatMap', 'totalSeats'));
    }


    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, SeatTemplate $seatTemplate)
    {
        try {
            $dataSeatTemplate= [];
            $message = 'Lưu nháp thành công !';
            if($request->action === 'publish'){
                $request->validate([
                    'seat_structure' => 'required|json',
                ]);
                $dataSeatTemplate['is_publish'] = 1;
                $dataSeatTemplate['is_active'] = 1;
                $message = 'Xuất bản thành công !';
                // Giải mã dữ liệu JSON và lưu vào trường seat_structure
            }
            $dataSeatTemplate['seat_structure'] = $request->seat_structure;
            // dd($dataSeatTemplate);
            $seatTemplate->seat_structure = json_decode($request->seat_structure, true);

            $seatTemplate->update($dataSeatTemplate);

            return redirect()->back()
                             ->with('success', $message);
        } catch (\Throwable $th) {
            // Trả về thông báo lỗi nếu có ngoại lệ xảy ra
            return back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }


    // public function changeCinema(Request $request)
    // {
    //     // Kiểm tra xem cinema_id gửi lên có hợp lệ không
    //     $cinema = Cinema::find($request->cinema_id);

    //     if ($cinema) {
    //         // Lưu cinema_id vào session
    //         Session::put('cinema_id', $cinema->id);
    //     }

    //     // Điều hướng lại hoặc trả về kết quả phù hợp
    //     return redirect()->back();
    // }
}
