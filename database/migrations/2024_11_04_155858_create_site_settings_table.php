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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_logo')->nullable(); // Logo website
            $table->string('site_name')->nullable(); // Tên website
            $table->string('brand_name')->nullable(); // Tên thương hiệu
            $table->string('slogan')->nullable(); // Slogan
            $table->string('phone')->nullable(); // Số điện thoại
            $table->string('email')->nullable(); // Email liên hệ
            $table->string('headquarters')->nullable(); // Trụ sở chính
            $table->string('business_license')->nullable(); // Giấy phép kinh doanh
            $table->string('working_hours')->nullable(); // Thời gian làm việc
            $table->string('facebook_link')->nullable(); // Link Facebook
            $table->string('youtube_link')->nullable(); // Link YouTube
            $table->string('instagram_link')->nullable(); // Link Instagram
            $table->string('privacy_policy_url')->nullable(); // Link Chính sách Bảo mật
            $table->string('terms_of_service_url')->nullable(); // Link Điều khoản Dịch vụ
            $table->text('introduction')->nullable(); // Phần giới thiệu
            $table->string('copyright')->nullable(); // Bản quyền
            $table->timestamps(); // Thời gian tạo và cập nhật
        });                    
    }
};
