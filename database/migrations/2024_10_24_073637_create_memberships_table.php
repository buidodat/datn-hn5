<?php

use App\Models\Rank;
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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->unique();
            $table->foreignIdFor(Rank::class)->default($this->getDefaultRankId());
            $table->string('code')->unique();
            $table->unsignedBigInteger('points')->default(0);
            $table->unsignedBigInteger('total_spent')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
    private function getDefaultRankId()
    {
        return Rank::where('total_spent', 0)->value('id');
    }
};
