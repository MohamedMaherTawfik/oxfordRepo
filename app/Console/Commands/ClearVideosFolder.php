<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class ClearVideosFolder extends Command
{
    /**
     * اسم الكوماند اللي هتستخدمه
     */
    protected $signature = 'videos:clear';

    /**
     * وصف الكوماند
     */
    protected $description = 'Delete all videos from the public/storage/videos folder';

    /**
     * تنفيذ الكوماند
     */
    public function handle()
    {
        $path = public_path('storage/videos');

        if (File::exists($path)) {
            $files = File::files($path);

            foreach ($files as $file) {
                File::delete($file);
            }

            $this->info('✅ All videos deleted successfully!');
        } else {
            $this->warn('⚠️ Folder not found: ' . $path);
        }

        return Command::SUCCESS;
    }
}