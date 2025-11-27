<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\accessMeeting;
use App\Models\Courses;
use App\Models\CourseSchedule;
use App\Models\Enrollments;
use App\Models\times;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class certificateControllerAdmin extends Controller
{
    public function index(Courses $course)
    {
        $schedules = CourseSchedule::where('courses_id', $course->id)->get();
        return view('adminCourse.schedules.index', compact('course', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Courses $course)
    {

        $day = request('day');
        return view('adminCourse.schedules.create', compact('course', 'day'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Courses $course)
    {
        $data = $request->except('_token');
        $data['courses_id'] = $course->id;
        CourseSchedule::create($data);
        return redirect()->route('admin.course-schedules.index', $course)->with('success', 'Schedule created successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSchedule $courseSchedule)
    {
        $courseSchedule->delete();
        return redirect()->back()->with('success', 'Schedule deleted successfully!');
    }

    public function students(Courses $course)
    {
        $schedules = CourseSchedule::where('courses_id', $course->id)->pluck('id');
        $times = times::whereIn('course_schedule_id', $schedules)
            ->where('day', request('day'))->where('time', 'like', request('time') . '%')
            ->get();

        return view('adminCourse.schedules.assigns', compact('course', 'times'));
    }


    public function revoke(accessMeeting $access)
    {
        $access->delete();
        return redirect()->back()->with('success', 'Access removed successfully');
    }


}
