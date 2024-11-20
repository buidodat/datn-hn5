<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Combo;
use App\Models\Food;
use App\Models\Post;
use App\Models\Showtime;
use App\Models\Slideshow;
use App\Models\Voucher;
use Illuminate\Http\Request;

class UpdateActiveController extends Controller
{
    public function branch(Request $request)
    {
        try {
            $branch = Branch::findOrFail($request->id);

            $branch->is_active = $request->is_active;
            $branch->save();
            $data = [
                'is_active' => $branch->is_active,
                'updated_date'=>$branch->updated_at->format('d/m/Y'),
                'updated_time'=>$branch->updated_at->format('H:i:s'),
            ];
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function cinema(Request $request)
    {
        try {
            $cinema = Cinema::findOrFail($request->id);

            $cinema->is_active = $request->is_active;
            $cinema->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$cinema]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$cinema]);
        }
    }
    public function food(Request $request)
    {
        try {
            $food = Food::findOrFail($request->id);

            $food->is_active = $request->is_active;
            $food->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$food]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$food]);
        }
    }
    public function combo(Request $request)
    {
        try {
            $combo = Combo::findOrFail($request->id);

            $combo->is_active = $request->is_active;
            $combo->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$combo]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$combo]);
        }
    }
    public function voucher(Request $request)
    {
        try {
            $voucher = Voucher::findOrFail($request->id);

            $voucher->is_active = $request->is_active;
            $voucher->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$voucher]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$voucher]);
        }
    }
    public function slideshow(Request $request)
    {
        try {
            $slideshow = Slideshow::findOrFail($request->id);

            $slideshow->is_active = $request->is_active;
            $slideshow->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$slideshow]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$slideshow]);
        }
    }
    public function post(Request $request)
    {
        try {
            $post = Post::findOrFail($request->id);

            $post->is_active = $request->is_active;
            $post->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$post]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$post]);
        }
    }
    public function showtime(Request $request)
    {
        try {
            $showtime = Showtime::findOrFail($request->id);

            $showtime->is_active = $request->is_active;
            $showtime->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.','data'=>$showtime]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.','data'=>$showtime]);
        }
    }
    //showtime và slideshow chưa xử lý
}
