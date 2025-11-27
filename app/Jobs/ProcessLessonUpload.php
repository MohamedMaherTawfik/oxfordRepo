<?php
namespace App\Jobs;

use App\Models\lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProcessLessonUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lessonId;
    protected $tempVideoPath;

    public function __construct(int $lessonId, string $tempVideoPath)
    {
        $this->lessonId = $lessonId;
        $this->tempVideoPath = $tempVideoPath;
    }

    public function handle(): void
    {
        try {
            Log::info("🚀 Starting video processing for Lesson ID: {$this->lessonId}");

            $lesson = lesson::find($this->lessonId);
            if (!$lesson) {
                Log::error("❌ Lesson not found: {$this->lessonId}");
                return;
            }

            if ($this->tempVideoPath) {
                if (request()->hasFile('video')) {
                    $lesson->video_url = request()->file('video')->store('lessonsVideo', 'public');
                }
            }
            Log::info("🏁 Video processing completed for Lesson #{$this->lessonId}");
        } catch (\Exception $e) {
            Log::error("🔥 Critical error in video job for Lesson #{$this->lessonId}: " . $e->getMessage());
        }
    }
}
