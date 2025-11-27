<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\visaenable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(contactSeeder::class);
        $this->call(userSeeder::class);
        $this->call(categoreySeeder::class);
        $this->call(courseSeeder::class);
        $this->call(footerSeeder::class);
        $this->call(diplomaSeeder::class);
        $this->call(visseeder::class);
    }
}
