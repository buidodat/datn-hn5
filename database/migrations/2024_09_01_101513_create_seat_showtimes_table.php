<?php

use App\Models\Seat;
use App\Models\Showtime;
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
        Schema::create('seat_showtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seat::class);
            $table->foreignIdFor(Showtime::class);
            $table->string('status');
            $table->unsignedInteger('price')->nullable();
            $table->timestamps();
            $table->unique(['seat_id','showtime_id'],'seat_showtime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_showtimes');
    }
};
