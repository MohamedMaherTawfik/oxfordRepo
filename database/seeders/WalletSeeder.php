<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create wallets for all existing teachers
        $teachers = User::where('role', 'teacher')->get();
        
        foreach ($teachers as $teacher) {
            Wallet::firstOrCreate(
                ['user_id' => $teacher->id],
                [
                    'balance' => 0,
                    'total_earned' => 0,
                    'total_withdrawn' => 0,
                ]
            );
        }
        
        echo "تم إنشاء محافظ للمعلمين بنجاح\n";
    }
}
