<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\quizRequest;
use App\Interfaces\CourseInterface;
use App\Models\questions;
use App\Models\quizes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    private $courseRepository;

    public function __construct(CourseInterface $courseInterface)
    {
        $this->courseRepository = $courseInterface;
    }
    public function index(Request $request)
    {
        $course = $this->courseRepository->getCourseBySlug($request->route('course'));

        $quizzes = quizes::where('courses_id', $course->id)->latest()->get();

        return view('teacherDashboard.quizzes.index', compact('quizzes', 'course'));
    }

    public function create(Request $request)
    {
        $course = $this->courseRepository->getCourseBySlug($request->route('course'));
        return view('teacherDashboard.quizzes.create', compact('course'));
    }

    public function store(quizRequest $request)
    {
        $course = $this->courseRepository->getCourseBySlug(request('course'));

        $fields = $request->validated();

        $fields['courses_id'] = $course->id;
        $fields['user_id'] = auth()->id();
        $fields['slug'] = Str::slug($fields['title']);

        quizes::create($fields);

        return redirect()
            ->route('teacherDashboard.quizzes.index', $course->slug)
            ->with('success', 'Quiz created successfully!');
    }

    public function show(Request $request)
    {
        $course = $this->courseRepository->getCourseBySlug($request->route('course'));
        $quiz = quizes::where('slug', request('quiz'))->first();
        $questions = questions::where('quizes_id', $quiz->id)->get();
        return view('teacherDashboard.quizzes.show', compact('course', 'quiz', 'questions'));
    }

    public function edit(Request $request)
    {
        $course = $this->courseRepository->getCourseBySlug($request->route('course'));
        $quiz = quizes::where('slug', request('quiz'))->first();
        return view('teacherDashboard.quizzes.edit', compact('quiz', 'course'));
    }

    public function update(Request $request)
    {
        $course = $this->courseRepository->getCourseBySlug($request->route('course'));

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',

        ]);
        $quiz = quizes::where('slug', request('quiz'))->first();
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return redirect()
            ->route('teacherDashboard.quizzes.index', $course->slug)
            ->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Request $request)
    {
        $course = $this->courseRepository->getCourseBySlug($request->route('course'));
        $quiz = quizes::where('id', request('quiz'))->first();
        $quiz->delete();

        return redirect()->route('teacherDashboard.quizzes.index', $course->slug)
            ->with('success', 'Quiz deleted!');
    }
}
