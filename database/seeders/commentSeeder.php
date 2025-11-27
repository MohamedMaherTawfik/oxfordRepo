<?php

namespace Database\Seeders;

use App\Models\comments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                'user_id' => 1,
                'lesson_id' => 1,
                'comment' => 'Great introduction to Laravel!',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 1,
                'comment' => 'Great introduction to Laravel!',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 1,
                'comment' => 'Great introduction to Laravel!',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 1,
                'comment' => 'Great introduction to Laravel!',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 1,
                'comment' => 'Great introduction to Laravel!',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 2,
                'comment' => 'I love the way routing is explained here.',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 3,
                'comment' => 'Eloquent ORM makes database interactions so easy.',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 4,
                'comment' => 'Advanced JavaScript concepts are well covered.',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 5,
                'comment' => 'Asynchronous JavaScript is a game changer!',
            ],
            [
                'user_id' => 1,
                'lesson_id' => 6,
                'comment' => 'Pandas is an amazing library for data analysis.',
            ],
        ];

        foreach ($comments as $comment) {
            comments::create($comment);
        }
    }
}
