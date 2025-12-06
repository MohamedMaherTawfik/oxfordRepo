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
        Schema::create('registration_video_settings', function (Blueprint $table) {
            $table->id();
            $table->string('youtube_url')->nullable(); // رابط يوتيوب
            $table->boolean('is_enabled')->default(true); // تفعيل/تعطيل الفيديو
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_video_settings');
    }
};
