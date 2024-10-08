<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SeatTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SeatTemplateController extends Controller
{
    public function store(Request $request ){
        $matrixIds = array_column(SeatTemplate::MATRIXS, 'id');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:seat_templates',
            'matrix_id' => ['required', Rule::in($matrixIds)],
            'description' => 'nullable|string|max:255'
        ], [
            'name.required' => 'Vui lòng nhập tên mẫu.',
            'name.unique' => 'Tên mẫu đã tồn tại.',
            'name.string' => 'Tên mẫu phải là kiểu chuỗi.',
            'name.max' => 'Độ dài tên mẫu không được vượt quá 255 ký tự.',
            'description.string' => 'Mô tả phải là kiểu chuỗi.',
            'description.max' => 'Độ dài mô tả không được vượt quá 255 ký tự.',
            'matrix_id.required' => "Vui lòng chọn ma trận ghế",
            'matrix_id.in' => 'Ma trận ghế không hợp lệ.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        try {
            $data = [
                'name'=>$request->name,
                'description'=>$request->description,
                'matrix_id'=>$request->matrix_id,
            ];
            $seatTemplate = SeatTemplate::create($data);

            return response()->json([
                'message' => "Thao tác thành công",
                'seatTemplate' => $seatTemplate,
            ], Response::HTTP_CREATED); // 201

        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }
}
