<?php

use App\Models\Movie;
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
        Schema::create('movie_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Movie::class);
            $table->string('language');
            $table->timestamps();
            $table->unique(['movie_id','language'],'movie_language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_languages');
    }
};
