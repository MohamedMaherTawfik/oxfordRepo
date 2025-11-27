<?php

use App\Models\certificate;
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
        Schema::table('assigned_certificates', function (Blueprint $table) {
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('id');
            $table->foreignIdFor(certificate::class)->nullable()->constrained('certificates')->nullOnDelete()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assigned_certificates', function (Blueprint $table) {
            //
        });
    }
};