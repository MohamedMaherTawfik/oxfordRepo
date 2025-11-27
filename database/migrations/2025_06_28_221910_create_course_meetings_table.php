<?php

use App\Models\Courses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Courses::class)->constrained()->cascadeOnDelete();
            $table->string('zoom_meeting_id');
            $table->text('join_url');
            $table->text('start_url')->nullable();
            $table->timestamp('start_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_meetings');
    }
};
