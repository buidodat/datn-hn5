<?php

namespace App\Jobs;

use App\Mail\BirthdayVoucherMail;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

class CheckBirthdayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::whereMonth('birthday', now()->month)
            ->get();
        /*thêm check email verify*/

        foreach ($users as $user) {
            $existVoucher = $user->vouchers()
                ->where('title', 'like', 'Voucher Sinh Nhật của ' . $user->name)
                ->whereMonth('start_date_time', now()->month)
                ->first();

            if ($existVoucher) {
                continue;
            }

            DB::transaction(function () use ($user) {
                $voucher = Voucher::create([
                    'code' => 'BDAY' . substr((string) Ulid::generate(), 0, 6),
                    'title' => 'Voucher Sinh Nhật của ' . $user->name,
                    'description' => 'Voucher giảm giá sinh nhật tháng ' . now()->month,
                    'start_date_time' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'end_date_time' => Carbon::now('Asia/Ho_Chi_Minh')->addDays(30),
                    'discount' => 50000,
                    'quantity' => 1,
                    'limit' => 1,
                    'is_active' => 1,
                    'is_publish' => 1,
                    'type' => 2,
                ]);

                $user->vouchers()->attach($voucher->id);

                Mail::to($user->email)->queue(new BirthdayVoucherMail($user, $voucher));
            });
        }
    }
}
