<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    \File::deleteDirectory(public_path('storage/videos'));
    \File::makeDirectory(public_path('storage/videos'));
})->daily();