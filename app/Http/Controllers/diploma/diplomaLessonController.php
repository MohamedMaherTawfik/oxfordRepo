<?php

namespace App\Http\Controllers\diploma;

use App\Http\Controllers\Controller;
use App\Models\Diplomas;
use App\Models\lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class diplomaLessonController extends Controller
{
    public function index(Diplomas $diploma)
    {
        $diploma->load('lessons');
        return view('admin.diplomas.lessons.index', compact('diploma'));
    }

    public function create(Diplomas $diploma)
    {
        return view('admin.diplomas.lessons.create', compact('diploma'));
    }

    public function store(Request $request, Diplomas $diploma)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'video_url' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lessons');
        }


        if ($request->hasFile('video_url')) {
            $data['video_url'] = $request->file('video_url')->store('lessons');
        }


        $data['user_id'] = Auth::id();
        $data['diplomas_id'] = $diploma->id;
        $data['slug'] = Str::slug($request->title) . '-' . uniqid() . '-' . time();
        lesson::create($data);

        return redirect()->route('diplomas.lesson', $diploma->id)
            ->with('success', 'Lesson created successfully');
    }

    public function delete(lesson $diploma)
    {
        $diploma->delete();

        return back()->with('success', 'Lesson deleted');
    }


}
