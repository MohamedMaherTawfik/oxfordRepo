<?php

namespace Database\Seeders;

use App\Models\studentReviews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class contactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        studentReviews::create([
            'address' => 'jordan',
            'phone' => '01000000000',
            'email' => 'email.com',
            'seen' => 0
        ]);
    }
}