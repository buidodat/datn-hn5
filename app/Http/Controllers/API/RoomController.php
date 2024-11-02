<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'type_room_id' => 'required|exists:type_rooms,id',
        //     'name' => [
        //         'required',
        //         'string',
        //         Rule::unique('rooms')->where(function ($query) use ($request) {
        //             return $query->where('cinema_id', $request->cinema_id);
        //         }),
        //     ],
        //     'seat_template_id' => 'required|exists:seat_templates,id',
        // ], [
        //     'name.required' => 'Vui lòng nhập tên phòng chiếu.',
        //     'name.unique' => 'Tên phòng đã tồn tại trong rạp.',
        //     'branch_id.required' => "Vui lòng chọn chi nhánh.",
        //     'branch_id.exists' => 'Chi nhánh bạn chọn không hợp lệ.',
        //     'cinema_id.required' => "Vui lòng chọn rạp chiếu.",
        //     'cinema_id.exists' => 'Rạp chiếu phim bạn chọn không hợp lệ.',
        //     'type_room_id.required' => "Vui lòng chọn loại phòng.",
        //     'type_room_id.exists' => 'Loại phòng chiếu bạn chọn không hợp lệ.',
        //     'seat_template_id.required' => "Vui lòng chọn mẫu sơ đòo ghế",
        //     'seat_template_id.exists' => 'Mẫu sơ đồ ghế không hợp lệ.'
        // ]);

        // if (Auth::user()->cinema_id == "") {
        //     $rules['branch_id'] = 'required|exists:branches,id';
        //     $rules['cinema_id'] = 'required|exists:cinemas,id';
        // }
        $rules = [
            'type_room_id' => 'required|exists:type_rooms,id',
            'name' => [
                'required',
                'string',
                Rule::unique('rooms')->where(function ($query) use ($request) {
                    return $query->where('cinema_id', $request->cinema_id);
                }),
            ],
            'seat_template_id' => 'required|exists:seat_templates,id',
        ];

        
        if (empty(Auth::user()->cinema_id)) {
            $rules['branch_id'] = 'required|exists:branches,id';
            $rules['cinema_id'] = 'required|exists:cinemas,id';
        }

        // Khởi tạo Validator với các quy tắc đã được cấu hình
        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'Vui lòng nhập tên phòng chiếu.',
            'name.unique' => 'Tên phòng đã tồn tại trong rạp.',
            'branch_id.required' => "Vui lòng chọn chi nhánh.",
            'branch_id.exists' => 'Chi nhánh bạn chọn không hợp lệ.',
            'cinema_id.required' => "Vui lòng chọn rạp chiếu.",
            'cinema_id.exists' => 'Rạp chiếu phim bạn chọn không hợp lệ.',
            'type_room_id.required' => "Vui lòng chọn loại phòng.",
            'type_room_id.exists' => 'Loại phòng chiếu bạn chọn không hợp lệ.',
            'seat_template_id.required' => "Vui lòng chọn mẫu sơ đồ ghế.",
            'seat_template_id.exists' => 'Mẫu sơ đồ ghế không hợp lệ.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        try {
            $room = DB::transaction(function () use ($request) {
                $dataRoom = [
                    'branch_id' => isset($request->branch_id) ? $request->branch_id : Auth::user()->cinema->branch_id,
                    'cinema_id' => isset($request->cinema_id) ? $request->cinema_id : Auth::user()->cinema_id,
                    'type_room_id' => $request->type_room_id,
                    'name' => $request->name,
                    'seat_template_id' => $request->seat_template_id,
                ];
                $room = Room::create($dataRoom);

                $seatTemplate = SeatTemplate::findOrFail($request->seat_template_id);

                // Chuyển đổi seat_structure từ JSON object thành array
                $seatStructureArray = json_decode($seatTemplate->seat_structure, true);

                // Tạo mảng để lưu trữ các ghế
                $dataSeats = [];

                // Lặp qua từng ghế trong seat_structure
                foreach ($seatStructureArray as $seat) {
                    $name = $seat['coordinates_y'] . $seat['coordinates_x'];

                    // Nếu là ghế đôi thì thêm tên ghế thứ hai
                    if ($seat['type_seat_id'] == 3) {
                        $name .= ', ' . $seat['coordinates_y'] . ($seat['coordinates_x'] + 1);
                    }

                    $dataSeats[] = [
                        'coordinates_x' => $seat['coordinates_x'],
                        'coordinates_y' => $seat['coordinates_y'],
                        'name' => $name,
                        'type_seat_id' => $seat['type_seat_id'],
                        'room_id' => $room->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Chèn ghế vào bảng seats
                Seat::insert($dataSeats);

                return $room;
            });


            return response()->json([
                'message' => "Thao tác thành công",
                'room' => $room,
            ], Response::HTTP_CREATED); // 201

        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }



    // public function update(Request $request, string $id)
    // {
    //     // Tìm phòng theo ID
    //     $room = Room::findOrFail($id); // Tìm phòng, nếu không tìm thấy sẽ trả về 404

    //     $matrixIds = array_column(Room::MATRIXS, 'id');
    //     $validator = Validator::make($request->all(), [
    //         'branch_id' => 'required|exists:branches,id',
    //         'cinema_id' => 'required|exists:cinemas,id',
    //         'type_room_id' => 'required|exists:type_rooms,id',
    //         'name' => [
    //             'required',
    //             'string',
    //             Rule::unique('rooms')->where(function ($query) use ($request, $room) {
    //                 return $query->where('cinema_id', $request->cinema_id)
    //                     ->where('id', '!=', $room->id); // Ignore the current room being updated
    //             }),
    //         ],
    //         'matrix_id' => ['required', Rule::in($matrixIds)],
    //     ], [
    //         'name.required' => 'Vui lòng nhập tên phòng chiếu.',
    //         'name.unique' => 'Tên phòng đã tồn tại trong rạp.',
    //         'branch_id.required' => "Vui lòng chọn chi nhánh.",
    //         'branch_id.exists' => 'Chi nhánh bạn chọn không hợp lệ.',
    //         'cinema_id.required' => "Vui lòng chọn rạp chiếu.",
    //         'cinema_id.exists' => 'Rạp chiếu phim bạn chọn không hợp lệ.',
    //         'type_room_id.required' => "Vui lòng chọn loại phòng.",
    //         'type_room_id.exists' => 'Loại phòng chiếu bạn chọn không hợp lệ.',
    //         'matrix_id.required' => "Vui lòng chọn ma trận ghế",
    //         'matrix_id.in' => 'Ma trận ghế không hợp lệ.'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors(),
    //         ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
    //     }

    //     try {
    //         DB::transaction(function () use ($request, $room) {
    //             // Cập nhật thông tin phòng
    //             $room->update([
    //                 'branch_id' => $request->branch_id,
    //                 'cinema_id' => $request->cinema_id,
    //                 'type_room_id' => $request->type_room_id,
    //                 'name' => $request->name,
    //                 'matrix_id' => $request->matrix_id,
    //             ]);

    //             // Lấy thông tin ma trận ghế từ const MATRIXS
    //             $matrixKey = array_search($request->matrix_id, array_column(Room::MATRIXS, 'id'));
    //             $matrix = Room::MATRIXS[$matrixKey];

    //             $rowSeatRegular = Room::ROW_SEAT_REGULAR;

    //             // Xóa các ghế cũ
    //             Seat::where('room_id', $room->id)->forceDelete();
    //             // Thêm lại các ghế mới dựa trên ma trận mới
    //             $dataSeats = [];
    //             for ($row = 0; $row < $matrix['max_row']; $row++) {
    //                 for ($col = 0; $col < $matrix['max_col']; $col++) {
    //                     $typeSeatId = ($row < $rowSeatRegular) ? 1 : 2;
    //                     $dataSeats[] = [
    //                         'room_id' => $room->id,
    //                         'type_seat_id' => $typeSeatId,
    //                         'coordinates_x' => $col + 1,
    //                         'coordinates_y' => chr(65 + $row), // Chuyển đổi số thành ký tự (A, B, C,...)
    //                         'name' => chr(65 + $row) . ($col + 1), // Ví dụ: A1, A2, B1, B2,...
    //                     ];
    //                 }
    //             }

    //             // Chèn các ghế mới vào bảng seats
    //             Seat::insert($dataSeats);
    //         });

    //         return response()->json([
    //             'message' => "Cập nhật thành công",
    //             'room' => $room,
    //         ], Response::HTTP_OK); // 200

    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'error' => $th->getMessage(),
    //         ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
    //     }
    // }




    public function update(Request $request, Room $room)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                Rule::unique('rooms')->where(function ($query) use ($request, $room) {
                    return $query->where('cinema_id', $request->cinema_id)
                        ->where('id', '!=', $room->id); // Bỏ qua phòng hiện tại đang cập nhật
                }),
            ],
        ];

        if (!$room->is_publish) {
            // Thêm các rule này nếu phòng chưa publish
            $rules['branch_id'] = 'required|exists:branches,id';
            $rules['cinema_id'] = 'required|exists:cinemas,id';
            $rules['type_room_id'] = 'required|exists:type_rooms,id';
            $rules['seat_template_id'] = 'required|exists:seat_templates,id';
        }

        // Thông báo lỗi tùy chỉnh
        $messages = [
            'name.required' => 'Vui lòng nhập tên phòng chiếu.',
            'name.unique' => 'Tên phòng đã tồn tại trong rạp.',
            'branch_id.required' => "Vui lòng chọn chi nhánh.",
            'branch_id.exists' => 'Chi nhánh bạn chọn không hợp lệ.',
            'cinema_id.required' => "Vui lòng chọn rạp chiếu.",
            'cinema_id.exists' => 'Rạp chiếu phim bạn chọn không hợp lệ.',
            'type_room_id.required' => "Vui lòng chọn loại phòng.",
            'type_room_id.exists' => 'Loại phòng chiếu bạn chọn không hợp lệ.',
            'seat_template_id.required' => "Vui lòng chọn mẫu sơ đồ ghế",
            'seat_template_id.exists' => 'Mẫu sơ đồ ghế không hợp lệ.'
        ];

        // Thực hiện validate
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        try {
            DB::transaction(function () use ($request, $room) {
                // Nếu phòng đã publish, chỉ cho phép cập nhật tên
                if ($room->is_publish) {
                    $room->update([
                        'name' => $request->name, // Chỉ cập nhật tên
                    ]);
                } else {
                    $room->update([
                        'branch_id' => $request->branch_id,
                        'cinema_id' => $request->cinema_id,
                        'type_room_id' => $request->type_room_id,
                        'name' => $request->name,
                        'seat_template_id' => $request->seat_template_id,
                    ]);

                    Seat::where('room_id', $room->id)->delete();

                    $seatTemplate = SeatTemplate::findOrFail($request->seat_template_id);

                    // Chuyển đổi seat_structure từ JSON object thành array
                    $seatStructureArray = json_decode($seatTemplate->seat_structure, true);
                    // Tạo mảng để lưu trữ các ghế
                    $dataSeats = [];

                    // Lặp qua từng ghế trong seat_structure
                    foreach ($seatStructureArray as $seat) {
                        $name = $seat['coordinates_y'] . $seat['coordinates_x'];

                        // Nếu là ghế đôi thì thêm tên ghế thứ hai
                        if ($seat['type_seat_id'] == 3) {
                            $name .= ', ' . $seat['coordinates_y'] . ($seat['coordinates_x'] + 1);
                        }

                        $dataSeats[] = [
                            'coordinates_x' => $seat['coordinates_x'],
                            'coordinates_y' => $seat['coordinates_y'],
                            'name' => $name,
                            'type_seat_id' => $seat['type_seat_id'],
                            'room_id' => $room->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    // Chèn ghế vào bảng seats
                    Seat::insert($dataSeats);
                }
            });
            session()->flash('success', 'Thao tác thành công!');
            return response()->json([
                'message' => "Cập nhật thành công",
                'room' => $room,
            ], Response::HTTP_OK); // 200

        } catch (\Throwable $th) {
            session()->flash('error', 'Đã sảy ra lỗi!');
            return response()->json([
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }













    public function updateActive(Request $request)
    {
        try {
            $room = Room::findOrFail($request->id);

            $room->is_active = $request->is_active;
            $room->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
}
