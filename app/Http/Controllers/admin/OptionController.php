<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\questions;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(questions $question)
    {
        $options = Option::where('questions_id', $question->id)->get();
        return view('teacherDashboard.options.index', compact('options', 'question'));
    }

    public function create(questions $question)
    {
        return view('teacherDashboard.options.create', compact('question'));
    }

    public function store(OptionRequest $request, questions $question)
    {
        $fields = $request->validated();
        $fields['questions_id'] = $question->id;

        Option::create($fields);

        return redirect()
            ->route('options.index', $question->id)
            ->with('success', 'Option created successfully!');
    }

    public function show(questions $question, Option $option)
    {
        return view('teacherDashboard.options.show', compact('question', 'option'));
    }

    public function edit(questions $question, Option $option)
    {
        return view('teacherDashboard.options.edit', compact('question', 'option'));
    }

    public function update(Request $request, questions $question, Option $option)
    {
        $request->validate([
            'option_text' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
        ]);

        $option->update([
            'option_text' => $request->option_text,
            'is_correct' => $request->is_correct,
        ]);

        return redirect()
            ->route('options.index', $question->id)
            ->with('success', 'Option updated successfully!');
    }

    public function destroy(questions $question, Option $option)
    {
        $option->delete();

        return redirect()
            ->route('options.index', $question->id)
            ->with('success', 'Option deleted successfully!');
    }
}
