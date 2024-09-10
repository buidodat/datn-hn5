<?php

use App\Models\MovieLanguage;
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
        Schema::create('movie_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MovieLanguage::class);
            $table->foreignIdFor(User::class);
            $table->unsignedTinyInteger('rating');
            $table->string('description');
            $table->timestamps();
            $table->unique(['movie_language_id','user_id'],'movie_language_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_reviews');
    }
};
