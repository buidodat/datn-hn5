<?php

use App\Models\Branch;
use App\Models\Cenima;
use App\Models\Cinema;
use App\Models\TypeRoom;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class);
            $table->foreignIdFor(Cinema::class);
            $table->foreignIdFor(TypeRoom::class);
            $table->string('name');
            $table->string('matrix_id');
            $table->json('row_seat')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
            $table->unique(['name','cinema_id'],'name_cinema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
