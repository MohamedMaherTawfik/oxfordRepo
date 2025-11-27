<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessQueueCommand extends Command
{
    /**
     * اسم الأمر اللي هتشغله من التيرمنال.
     *
     * مثال: php artisan app:process-queue
     */
    protected $signature = 'app:process-queue';

    /**
     * وصف الأمر (بيظهر في php artisan list).
     */
    protected $description = 'تشغيل queue worker لمعالجة الجوبات في الخلفية';

    /**
     * الكود اللي يتنفذ لما تشغّل الأمر.
     */
    public function handle()
    {
        $this->info('🚀 تشغيل queue worker...');

        // تشغيل queue worker مؤقتًا لحد ما يخلص الجوبات الحالية
        exec('php artisan queue:work --stop-when-empty --quiet');

        $this->info('✅ تم تشغيل ومعالجة الكيو بنجاح.');

        return Command::SUCCESS;
    }
}
