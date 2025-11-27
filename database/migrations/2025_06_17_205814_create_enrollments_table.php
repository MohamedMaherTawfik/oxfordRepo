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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Courses::class)->constrained()->cascadeOnDelete();
            $table->enum('enrolled', ['yes', 'no'])->default('no');
            $table->double('price');
            $table->string('transaction_type')->default('null');
            $table->string('transaction_status')->default('null');
            $table->string('transaction_id')->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};