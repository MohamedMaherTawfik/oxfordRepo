<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\lessonRequest;
use App\Interfaces\LessonInterface;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class lessonController extends Controller
{
    use apiResponse;
    private $lessonRepository;

    public function __construct(LessonInterface $lessonInterface)
    {
        $this->lessonRepository = $lessonInterface;
    }

    public function allLessons()
    {
        $lessons = $this->lessonRepository->allLessons(request('id'));
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
        $data = $this->lessonRepository->getLesson(request('id'));
        try {
            if (!empty($data)) {
                $comments = comments::with(['user:id,name,photo'])->where('lesson_id', $data->id)->get();
                return response()->json([
                    'status' => 'true',
                    'message' => 'lesson with user and comments with user fetched',
                    'lesson' => $data,
                    'comments' => $comments,
                ], 200);
            } else {
                return $this->notFound(__('messages.notFound_Message'));
            }
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }
    public function createLesson(lessonRequest $request)
    {
        $fields = $request->validated();
        if (request()->hasFile('image')) {
            $fields['image'] = request()->file('image')->store('lessonsImage', 'public');
        }
        if (request()->hasFile('video_url')) {
            $fields['video_url'] = request()->file('video_url')->store('lessonsVideo', 'public');
        }
        $lesson = $this->lessonRepository->createLessonApi($fields, request('id'));
        return $this->success($lesson, 'Lesson Created Successfully');
    }
    public function updateLesson()
    {
        $fields = request()->all();
        $lesson = $this->lessonRepository->updateLesson($fields, request('id'));
        return $this->success($lesson, 'lesson Updated Successfully');
    }

    public function deleteLesson()
    {
        $this->lessonRepository->deleteLesson(request('id'));
        return $this->noContent();
    }
}
