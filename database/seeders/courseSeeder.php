<?php

namespace Database\Seeders;

use App\Models\Courses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class courseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [

            [
                'categorey_id' => 1,
                'title' => 'Flutter for Mobilej Apps',
                'description' => 'Learn to build beautiful mobile applications using Flutter.',
                'price' => 34.99,
                'admin_price' => 34.99,
                'duration' => '50',
                'start_date' => '2024-03-01',
                'level' => 'Advanced',
                'slug' => 'flutfter-for-mobile-apps',
                'user_id' => 1,
            ],

        ];

        foreach ($courses as $course) {
            Courses::create($course);
        }


    }
}
