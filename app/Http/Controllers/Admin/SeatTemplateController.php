<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeatTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function edit(SeatTemplate $seatTemplate)
    {
        // Lấy cấu trúc ma trận từ hằng số MATRIXS
        $matrix = SeatTemplate::getMatrixById($seatTemplate->matrix_id);

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


    public function updateSeatStructure(Request $request, SeatTemplate $seatTemplate)
    {
        try {
            $dataSeatTemplate = [
                'is_active' => isset($request->is_active) ? 1 : 0, // Mặc định cập nhật is_active
            ];

            if ($request->action === 'publish' && !$seatTemplate->is_publish) {
                // Nếu hành động là publish và chưa được publish trước đó
                $dataSeatTemplate = array_merge($dataSeatTemplate, [
                    'is_publish' => 1,
                    'is_active' => 1,
                    'seat_structure' => $request->seat_structure,
                ]);
            } elseif ($request->action === 'draft' && !$seatTemplate->is_publish) {
                // Nếu là hành động draft và chưa publish
                $dataSeatTemplate['seat_structure'] = $request->seat_structure;
            }

            // Thực hiện cập nhật
            $seatTemplate->update($dataSeatTemplate);
            return redirect()->back()
                ->with('success', 'Thao tác thành công');
        } catch (\Throwable $th) {
            // Trả về thông báo lỗi nếu có ngoại lệ xảy ra
            return back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
    public function destroy(SeatTemplate $seatTemplate)
    {
        try {
            if ($seatTemplate->is_publish) {
                return redirect()->back()->with('error', 'Đã sảy ra lỗi, vui lòng thử lại sau.');
            }
            $seatTemplate->delete();
            return redirect()->back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

}
