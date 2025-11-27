<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\questions;
use App\Models\quizes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function index()
    {
        $quiz = quizes::where('slug', request('slug'))->firstOr();
        $questions = questions::where('quizes_id', $quiz->id)->latest()->get();
        return view('teacherDashboard.questions.index', compact('questions', 'quiz'));
    }

    public function create()
    {
        $quiz = quizes::where('slug', request('quiz'))->firstOr();
        return view('teacherDashboard.questions.create', compact('quiz'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'questions' => 'required|array',
            'questions.*.text' => [
                'required',
                'string',
                Rule::unique('questions', 'question')->where(fn($q) => $q->where('quizes_id', $request->quiz)),
            ],
            'questions.*.options' => 'required|array|size:4',
            'questions.*.options.*.text' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|in:true,false',
        ], [
            'questions.*.text.unique' => 'هذا السؤال موجود بالفعل، من فضلك اكتب سؤالًا مختلفًا.',
            'questions.*.text.required' => 'السؤال مطلوب.',
            'questions.*.options.*.text.required' => 'الخيار مطلوب.',
            'questions.*.options.*.is_correct.required' => 'حدد إذا كانت الإجابة صحيحة أم لا.',
        ]);

        $quiz = quizes::findOrFail($request->quiz);

        foreach ($validated['questions'] as $questionData) {
            $question = $quiz->questions()->create([
                'question' => $questionData['text'],
                'quizes_id' => $quiz->id,
                'slug' => Str::slug($questionData['text']),
            ]);

            foreach ($questionData['options'] as $option) {
                $question->options()->create([
                    'option_text' => $option['text'],
                    'is_correct' => filter_var($option['is_correct'], FILTER_VALIDATE_BOOLEAN),
                    'slug' => Str::slug($option['text']),
                ]);
            }
        }

        return redirect()
            ->route('questions.create', [request('course'), $quiz->slug])
            ->with('success', 'Questions created successfully!');
    }


    public function destroy()
    {
        $course = Courses::where('slug', request('course'))->first();
        $quiz = quizes::where('slug', request('quiz'))->first();
        $question = questions::where('slug', request('question'));
        $question->delete();

        return redirect()
            ->route('teacherDashboard.quizzes.show', [$course->slug, $quiz->slug])
            ->with('success', 'Question deleted successfully!');
    }
}