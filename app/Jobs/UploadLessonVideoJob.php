<?php

namespace App\Jobs;

use App\Models\lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadLessonVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lessonId;
    protected $tempPath;

    public function __construct($lessonId, $tempPath)
    {
        $this->lessonId = $lessonId;
        $this->tempPath = $tempPath;
    }

    public function handle()
    {
        $lesson = lesson::find($this->lessonId);
        if (!$lesson)
            return;

        try {
            $fileName = basename($this->tempPath);
            $finalPath = 'lessonsvideo/' . $fileName;

            // ننقل الملف داخل نفس الـ disk
            if (Storage::disk('public')->exists($this->tempPath)) {
                Storage::disk('public')->move($this->tempPath, $finalPath);

                $lesson->update(['video_url' => $finalPath]);
            } else {
                \Log::error('UploadLessonVideoJob: Temp file not found', [
                    'lesson_id' => $this->lessonId,
                    'path' => $this->tempPath,
                ]);
            }
        } catch (\Throwable $th) {
            \Log::error('UploadLessonVideoJob failed: ' . $th->getMessage(), [
                'lesson_id' => $this->lessonId,
                'trace' => $th->getTraceAsString(),
            ]);
        }
    }

}
