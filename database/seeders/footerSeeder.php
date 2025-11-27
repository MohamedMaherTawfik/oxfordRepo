<?php

namespace Database\Seeders;

use App\Models\footer;
use App\Models\signphoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class footerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        footer::create([
            'whatsapp' => 'whatsapp.com',
            'x' => 'twitter.com',
            'facebook' => 'facebook.com',
            'instgram' => 'instagram.com',
            'telegram' => 'linkedin.com',
            'email' => 'email.com',
            'address' => 'address.com',
            'phone' => 'phone.com',
            'google_play' => 'google.com',
            'app_store' => 'apple.com',
        ]);

        signphoto::create([
            'login' => 'login.png',
            'register' => 'register.png',
        ]);
    }
}