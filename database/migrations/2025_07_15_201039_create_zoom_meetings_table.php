<?php

use App\Models\Courses;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Courses::class)->nullable()->constrained()->onDelete('cascade');
            $table->string('class_topic');
            $table->dateTime('class_date_and_time');
            $table->string('meeting_id')->nullable();
            $table->string('meeting_password')->nullable();
            $table->text('start_url')->nullable();
            $table->text('join_url')->nullable();
            $table->string('status')->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_meetings');
    }
};
