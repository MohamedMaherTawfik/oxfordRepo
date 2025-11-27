<?php

namespace Database\Seeders;

use App\Models\visaenable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class visseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        visaenable::create([
            'id' => 1,
            'visa_enable' => true,
            'cash_enable' => true
        ]);
    }
}
