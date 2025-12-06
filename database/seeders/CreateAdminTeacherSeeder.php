<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\applyTeacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@oxford.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        echo "Admin created:\n";
        echo "Email: {$admin->email}\n";
        echo "Password: password\n\n";

        // إنشاء Teacher
        $teacher = User::firstOrCreate(
            ['email' => 'teacher@oxford.com'],
            [
                'name' => 'المعلم',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]
        );

        // إنشاء سجل applyTeacher للمعلم
        applyTeacher::firstOrCreate(
            ['user_id' => $teacher->id],
            [
                'topic' => 'General',
                'phone' => '1234567890',
                'cv' => 'default',
                'certificate' => 'default',
                'status' => 'accepted',
            ]
        );

        echo "Teacher created:\n";
        echo "Email: {$teacher->email}\n";
        echo "Password: password\n";
    }
}

