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
        Schema::create('teacher_support_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // المعلم المرسل
            $table->string('subject'); // موضوع الرسالة
            $table->text('message'); // محتوى الرسالة
            $table->enum('status', ['pending', 'read', 'replied'])->default('pending'); // حالة الرسالة
            $table->text('admin_reply')->nullable(); // رد الإدارة
            $table->foreignId('replied_by')->nullable()->constrained('users')->nullOnDelete(); // من رد على الرسالة
            $table->timestamp('replied_at')->nullable(); // وقت الرد
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_support_messages');
    }
};
