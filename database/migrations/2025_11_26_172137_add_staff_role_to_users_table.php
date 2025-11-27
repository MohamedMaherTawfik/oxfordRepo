<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we need to recreate the table
        if (DB::getDriverName() === 'sqlite') {
            // SQLite doesn't support MODIFY COLUMN, so we'll just note that staff role is available
            // The enum constraint is not enforced in SQLite anyway
        } else {
            // For MySQL/MariaDB
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('teacher', 'user', 'admin', 'staff') DEFAULT 'user'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('teacher', 'user', 'admin') DEFAULT 'user'");
        }
    }
};
