<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SeatTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SeatTemplateController extends Controller
{
    public function store(Request $request ){
        $matrixIds = array_column(SeatTemplate::MATRIXS, 'id');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:seat_templates',
            'matrix_id' => ['required', Rule::in($matrixIds)],
            'description' => 'required|string|max:255'
        ], [
            'name.required' => 'Vui lòng nhập tên mẫu.',
            'name.unique' => 'Tên mẫu đã tồn tại.',
            'name.string' => 'Tên mẫu phải là kiểu chuỗi.',
            'name.max' => 'Độ dài tên mẫu không được vượt quá 255 ký tự.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'description.string' => 'Mô tả phải là kiểu chuỗi.',
            'description.max' => 'Độ dài mô tả không được vượt quá 255 ký tự.',
            'matrix_id.required' => "Vui lòng chọn ma trận ghế",
            'matrix_id.in' => 'Ma trận ghế không hợp lệ.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }
        $scopeRegular = SeatTemplate::SCOPE_REGULAR;
        $scopeDouble= SeatTemplate::SCOPE_DOUBLE;
        try {
            $data = [
                'name'=>$request->name,
                'description'=>$request->description,
                'matrix_id'=>$request->matrix_id,
                'row_regular' =>$scopeRegular['default'],
                'row_double'=>$scopeDouble['default']
            ];
            $seatTemplate = SeatTemplate::create($data);

            return response()->json([
                'message' => "Thao tác thành công",
                'seatTemplate' => $seatTemplate,
            ], Response::HTTP_CREATED); // 201

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }


    public function update(Request $request, SeatTemplate $seatTemplate)
    {
        // Lấy danh sách ID ma trận
        $matrixIds = array_column(SeatTemplate::MATRIXS, 'id');

        // Xác thực dữ liệu đầu vào
        $rules = [
            'name' =>'required|string|max:255|unique:seat_templates,name,'.$seatTemplate->id,
            'description' =>'required|string|max:255'
        ];

        if (!$seatTemplate->is_publish) {
            // Chỉ thêm các rule này nếu phòng chưa publish
            $rules['matrix_id'] = ['required', Rule::in($matrixIds)];
        }

        // Thông báo lỗi tùy chỉnh
        $messages = [
            'name.required' => 'Vui lòng nhập tên mẫu.',
            'name.unique' => 'Tên mẫu đã tồn tại.',
            'name.string' => 'Tên mẫu phải là kiểu chuỗi.',
            'name.max' => 'Độ dài tên mẫu không được vượt quá 255 ký tự.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'description.string' => 'Mô tả phải là kiểu chuỗi.',
            'description.max' => 'Độ dài mô tả không được vượt quá 255 ký tự.',
            'matrix_id.required' => "Vui lòng chọn ma trận ghế",
            'matrix_id.in' => 'Ma trận ghế không hợp lệ.'
        ];

        // Thực hiện validate
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        try {
            DB::transaction(function () use ($request, $seatTemplate) {
                // Nếu phòng đã publish, chỉ cho phép cập nhật tên
                if ($seatTemplate->is_publish) {
                    $seatTemplate->update([
                        'name' => $request->name,
                        'description' => $request->description,
                    ]);
                } else {
                    // Cập nhật thông tin phòng và ghế nếu chưa publish
                    $seatTemplate->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'matrix_id' => $request->matrix_id,
                    ]);
                }
            });

            return response()->json([
                'message' => "Cập nhật thành công",
            ], Response::HTTP_OK); // 200

        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }

    public function updateActive(Request $request,SeatTemplate $seatTemplate)
    {
        try {
            if($seatTemplate->is_publish){
                $seatTemplate->update([
                    'is_active' => $request->is_active
                ]);
                return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công.']);
            } else {
                // Nếu template chưa được publish, trả về thông báo lỗi
                return response()->json(['success' => false, 'message' => 'Template chưa được publish.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
}
