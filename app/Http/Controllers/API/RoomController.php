<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'type_room_id' => 'required|exists:type_rooms,id',
            'name' => 'required|string|max:255',
            'matrix_id' => 'required|integer',
        ],[
            'name.required' => 'Vui lòng nhập tên phòng chiếu.',
            'name.unique' => 'Tên phòng đã tồn tại trong rạp.',
            'branch_id.required' => "Vui lòng chọn chi nhánh.",
            'cinema_id.required' => "Vui lòng chọn rạp chiếu.",
            'type_room_id.required' => "Vui lòng chọn loại phòng.",
            'matrix_id.required' =>"Vui lòng chọn ma trận ghế"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        try {
            $room = DB::transaction(function () use($request) {
                $dataRoom = [
                    'branch_id' => $request->branch_id,
                    'cinema_id' => $request->cinema_id,
                    'type_room_id' => $request->type_room_id,
                    'name' => $request->name,
                    'matrix_id' => $request->matrix_id,
                ];
                $room = Room::create($dataRoom);

                $matrixKey = array_search($request->matrix_id, array_column(Room::MATRIXS, 'id'));
                $matrix = Room::MATRIXS[$matrixKey];

                $rowSeatRegular =  Room::ROW_SEAT_REGULAR;

                $rowSeatDouble =  Room::ROW_SEAT_DOUBLE;


                for ($row=0; $row <$matrix['max_row']  ; $row++) {
                    for ($col=0; $col <$matrix['max_col'] ; $col++) {
                        if($row <= $rowSeatRegular){
                            $typeSeatId = 1;
                        }else{
                            $typeSeatId = 2;
                        }
                        $dataSeats[] = [
                            'room_id' => $room->id,
                            'type_seat_id' => $typeSeatId,
                            'coordinates_x' => $col + 1,
                            'coordinates_y' => chr(65 + $row), // Chuyển đổi số thành ký tự (A, B, C,...)
                            'name' => chr(65 + $row) . ($col + 1), // Ví dụ: A1, A2, B1, B2,...
                        ];
                    }
                }
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
    public function convertNumberToLetters($number = Room::ROW_SEAT_REGULAR)
    { // hàm chuyển đổi số thành mangr chữ câis
        $letters = [];

        for ($i = 0; $i < $number; $i++) {
            $letters[] = chr(65 + $i); // 65 là mã ASCII của chữ cái 'A'
        }

        return $letters;
    }
}
