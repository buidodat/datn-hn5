<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Food;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function checkout()
    {
        $data = Combo::query()->where('is_active', '1')->with('comboFood')->latest('id')->get();
        $foods = Food::query()->select('id', 'name', 'type')->get();

        return view('client.checkout', compact('data', 'foods'));
    }


    public function applyVoucher(Request $request)
    {

        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để nhập mã voucher'], 403);
        }

        $voucher = Voucher::where('code', $request->code)->first();

        if (!$voucher) {
            return response()->json(['error' => 'Voucher không hợp lệ.'], 400);
        }

        if ($voucher->start_date_time > now() || $voucher->end_date_time < now()) {
            return response()->json(['error' => 'Voucher không còn hiệu lực.'], 400);
        }

        if ($voucher->quantity <= 0) {
            return response()->json(['error' => 'Voucher đã được sử dụng hết.'], 400);
        }

        $userVoucherCount = UserVoucher::where('user_id', auth()->id())
            ->where('voucher_id', $voucher->id)
            ->count();
        if ($userVoucherCount >= $voucher->limit) {
            return response()->json(['error' => 'Bạn đã sử dụng voucher này đủ số lần cho phép.'], 400);
        }

        /*DB::transaction(function() use ($voucher) {
            UserVoucher::create([
                'user_id' => auth()->id(),
                'voucher_id' => $voucher->id,
                'used_at' => now(),
                'discount_applied' => $voucher->discount,
            ]);

            $voucher->decrement('quantity');
        });*/

        return response()->json([
            'success' => 'Áp dụng voucher thành công!',
            'id' => $voucher->id,
            'voucher_code' => $voucher->code,
            'discount' => $voucher->discount,
        ]);
    }

//    public function cancelVoucher(Request $request)
//    {
//        $userVoucher = UserVoucher::where('user_id', auth()->id())
//            ->where('voucher_id', $request->voucher_id)
//            ->first();
//
//        if (!$userVoucher) {
//            return response()->json(['error' => 'Voucher không tồn tại hoặc chưa được áp dụng.'], 400);
//        }
//
//        /*$voucher = Voucher::find($userVoucher->voucher_id);
//        if ($voucher) {
//            $voucher->increment('quantity');
//        }
//
//        $userVoucher->delete();*/
//
//        DB::transaction(function() use ($userVoucher) {
//            $voucher = Voucher::find($userVoucher->voucher_id);
//            if ($voucher) {
//                $voucher->increment('quantity');
//            }
//
//            $userVoucher->delete();
//        });
//
//        return response()->json(['success' => 'Hủy voucher thành công!']);
//    }



}
