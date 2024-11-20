<?php

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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('img_thumbnail')->nullable();
            $table->string('description')->nullable();
            $table->string('director');
            $table->string('cast')->nullable();
            $table->unsignedInteger('duration');
            $table->string('rating')->nullable();
            $table->date('release_date');
            $table->date('end_date');
            $table->string('trailer_url')->nullable();
            $table->unsignedInteger('surcharge')->nullable()->default(0);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_special')->default(false);
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
