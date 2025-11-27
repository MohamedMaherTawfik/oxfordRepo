<?php

namespace Database\Seeders;

use App\Models\Diplomas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class diplomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diplomas = [
            [
                'name' => 'Diploma',
                'price' => 100,
                'description' => 'Diploma description',
                'duration' => 20,
                'start_date' => '2023-01-01',
                'user_id' => 1,
                'image' => 'diploma.jpg',
                'slug' => 'diploma-1',
            ],
            [
                'name' => 'Diploma 2',
                'price' => 200,
                'description' => 'Diploma 2 description',
                'duration' => 30,
                'start_date' => '2023-02-01',
                'user_id' => 1,
                'image' => 'diploma2.jpg',
                'slug' => 'diploma-2',
            ]
        ];

        foreach ($diplomas as $diploma) {
            Diplomas::create($diploma);
        }
    }
}
