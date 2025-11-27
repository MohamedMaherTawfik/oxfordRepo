<?php

namespace App\Http\Controllers\gate;

use App\Http\Controllers\Controller;
use App\Models\Diplomas;
use App\Models\lesson;
use App\Models\sendCertificates;
use Illuminate\Http\Request;

class GateController extends Controller
{
    public function index()
    {
        return view('gate.index');
    }

    public function Diplomas()
    {
        $diplomas = \App\Models\Diplomas::get();
        return view('gate.diplomas', compact('diplomas'));
    }

    public function show()
    {
        $diplomas = \App\Models\Diplomas::where('slug', request('slug'))->first();
        return view('gate.singleDiploma', compact('diplomas'));
    }

    public function showcategorey()
    {
        $categories = \App\Models\DiplomasCategorey::with('diplomas')->where('slug', request('slug'))->first();
        return view('gate.categories', compact('categories'));
    }

    public function showDiplomas()
    {
        $diplomas = \App\Models\Diplomas::where('slug', request('slug'))->first();
        $relatedCourses = Diplomas::where('diplomas_categorey_id', $diplomas->diplomas_categorey_id)->take(3)->get();
        $zoommeeting = \App\Models\ZoomMeeting::where('diplomas_id', $diplomas->id)->first();
        $requests = \App\Models\RequestCertificate::where('diplomas_id', $diplomas->id)->where('user_id', auth()->user()->id)->first();
        $send = sendCertificates::where('diplomas_id', $diplomas->id)->where('user_id', auth()->user()->id)->first();
        return view('gate.showDiploma', compact('diplomas', 'relatedCourses', 'zoommeeting', 'requests', 'send'));
    }

    public function me()
    {
        $enrollments = \App\Models\Enrollments::where('user_id', auth()->user()->id)->whereNotNull('diplomas_id')->get();
        $diplomas = \App\Models\Diplomas::whereIn('id', $enrollments->pluck('diplomas_id'))->get();
        return view('gate.me', compact('diplomas'));

    }

    public function showLesson(lesson $lesson)
    {
        return view('gate.singleLesson', compact('lesson'));
    }


    public function request(Diplomas $diploma)
    {
        $diploma->requests()->create([
            'user_id' => auth()->user()->id,
            'diplomas_id' => $diploma->id,
        ]);
        return redirect()->back()->with('success', 'تم ارسال طلبك بنجاح');
    }

}
