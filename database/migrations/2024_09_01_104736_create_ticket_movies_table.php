<?php

use App\Models\Room;
use App\Models\Seat;
use App\Models\Showtime;
use App\Models\Ticket;
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
        Schema::create('ticket_movies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ticket::class);
            $table->foreignIdFor(Showtime::class);
            $table->foreignIdFor(Seat::class);
            $table->foreignIdFor(Room::class);
            /*$table->string('code')->comment('Mã từ bảng Vé tickets');*/
            $table->unsignedInteger('price')->comment('Giá vé gốc  tại thời điểm mua chưa trừ point và voucher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_movies');
    }
};
