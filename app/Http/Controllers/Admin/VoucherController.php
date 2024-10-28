<?php

namespace App\Http\Controllers\Admin;

use App\Events\VoucherCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVoucherRequest;
use App\Http\Requests\Admin\UpdateVoucherRequest;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.vouchers.';

    public function index()
    {
        $data = Voucher::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        $uniqueCode = $this->generateCode();

        return view(self::PATH_VIEW . __FUNCTION__, compact('users','uniqueCode'));
    }

    public function generateCode(){
        do {
            $code = strtoupper(Str::random(8));
            $codeExist = Voucher::where('code', $code)->exists();
        } while ($codeExist);
        return $code;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $data = $request->all();

        $data['start_date_time'] = Carbon::parse($request->input('start_date_time'), 'Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $data['end_date_time'] = Carbon::parse($request->input('end_date_time'), 'Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;

        $voucher = Voucher::create($data);

        if ($voucher->is_publish && $voucher->is_active) {
            broadcast(new VoucherCreated($voucher))->toOthers();
        }

        return redirect()->route('admin.vouchers.index')->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voucher = Voucher::query()->findOrFail($id);
        /*dd($voucher->start_date_time);*/
        return view(self::PATH_VIEW . __FUNCTION__, compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, string $id)
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active') ? 1 : 0;
            $voucher = Voucher::query()->findOrFail($id);

            $voucher->update($data);

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
