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

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
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

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function food(Request $request)
    {
        try {
            $food = Food::findOrFail($request->id);

            $food->is_active = $request->is_active;
            $food->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function combo(Request $request)
    {
        try {
            $combo = Combo::findOrFail($request->id);

            $combo->is_active = $request->is_active;
            $combo->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function voucher(Request $request)
    {
        try {
            $voucher = Voucher::findOrFail($request->id);

            $voucher->is_active = $request->is_active;
            $voucher->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function slideshow(Request $request)
    {
        try {
            $slideshow = Slideshow::findOrFail($request->id);

            $slideshow->is_active = $request->is_active;
            $slideshow->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function post(Request $request)
    {
        try {
            $post = Post::findOrFail($request->id);

            $post->is_active = $request->is_active;
            $post->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function showtime(Request $request)
    {
        try {
            $showtime = Showtime::findOrFail($request->id);

            $showtime->is_active = $request->is_active;
            $showtime->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
}
