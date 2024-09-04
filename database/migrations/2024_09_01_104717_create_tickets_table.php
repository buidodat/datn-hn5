<?php

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Payment::class);
            $table->unsignedInteger('voucher_id')->nullable();
            $table->string('voucher_code')->nullable();
            $table->unsignedInteger('voucher_discount')->nullable();
            $table->string('code')->unique()->comment('Mã quét Qr hoặc mã vạch');
            $table->unsignedBigInteger('total_price');
            $table->string('status');
            $table->dateTime('expiry')->comment('hạn sử dụng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
