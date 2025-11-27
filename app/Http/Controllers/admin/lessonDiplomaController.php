<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\api\student\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Diplomas;
use App\Models\lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class lessonDiplomaController extends Controller
{
    use ApiResponse;
    public function allLessons()
    {
        $lessons = Diplomas::with('lessons')->get();
        try {
            if (count($lessons) == 0) {
                return $this->noContent();
            }
            return $this->success($lessons, 'All lessons fetched Successflly');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }
    public function lessonDetails()
    {
        $data = lesson::find(request('id'));
        try {
            if (!empty($data)) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'lesson with user and comments with user fetched',
                    'lesson' => $data,
                ], 200);
            } else {
                return $this->notFound('Resource not found');
            }
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }
    public function createLesson(Request $request)
    {
        $fields = $request->all();
        if (request()->hasFile('image')) {
            $fields['image'] = request()->file('image')->store('lessonsImage', 'public');
        }
        if (request()->hasFile('video_url')) {
            $fields['video_url'] = request()->file('video_url')->store('lessonsVideo', 'public');
        }
        $fields['slug'] = Str::slug($fields['title']) . '-' . time();
        $lesson = lesson::create([
            'title' => $fields['title'] ?? 'null',
            'description' => $fields['description'] ?? 'null',
            'image' => $fields['image'] ?? 'null',
            'video_url' => $fields['video_url'] ?? 'null',
            'diplomas_id' => request('id'),
            'slug' => $fields['slug'],
            'user_id' => auth()->id(),
        ]);
        return $this->success($lesson, 'Lesson Created Successfully');
    }
    public function updateLesson()
    {
        $fields = request()->all();
        if (request()->hasFile('image')) {
            $fields['image'] = request()->file('image')->store('lessonsImage', 'public');
        }
        if (request()->hasFile('video_url')) {
            $fields['video_url'] = request()->file('video_url')->store('lessonsVideo', 'public');
        }
        $lesson = lesson::find(request('id'));
        $lesson->update($fields);
        return $this->success($lesson, 'lesson Updated Successfully');
    }

    public function deleteLesson()
    {
        $lesson = lesson::find(request('id'));
        $lesson->delete();
        return $this->noContent();
    }
}
