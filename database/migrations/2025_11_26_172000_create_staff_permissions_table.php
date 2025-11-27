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
        Schema::create('staff_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('manage_users')->default(false);
            $table->boolean('manage_teachers')->default(false);
            $table->boolean('manage_courses')->default(false);
            $table->boolean('manage_categories')->default(false);
            $table->boolean('manage_diplomas')->default(false);
            $table->boolean('manage_payments')->default(false);
            $table->boolean('manage_certificates')->default(false);
            $table->boolean('manage_applies')->default(false);
            $table->boolean('manage_homepage')->default(false);
            $table->boolean('manage_footer')->default(false);
            $table->boolean('manage_staff')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_permissions');
    }
};
