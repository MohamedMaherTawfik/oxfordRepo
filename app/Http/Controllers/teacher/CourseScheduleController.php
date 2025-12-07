<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\accessMeeting;
use App\Models\Courses;
use App\Models\CourseSchedule;
use App\Models\times;
use Illuminate\Http\Request;

class CourseScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Courses $course)
    {
        $schedules = CourseSchedule::where('courses_id', $course->id)->get();
        return view('teacherDashboard.schedules.index', compact('course', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Courses $course)
    {

        $day = request('day');
        return view('teacherDashboard.schedules.create', compact('course', 'day'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Courses $course)
    {
        $validated = $request->validate([
            'day' => 'required|string|in:saturday,sunday,monday,tuesday,wednesday,thursday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'day.required' => __('teacher.day') . ' ' . __('teacher.is_required'),
            'start_time.required' => __('teacher.start_time') . ' ' . __('teacher.is_required'),
            'end_time.required' => __('teacher.end_time') . ' ' . __('teacher.is_required'),
            'end_time.after' => __('teacher.end_time_must_be_after_start'),
        ]);

        // Check minimum duration (30 minutes)
        $start = \Carbon\Carbon::parse($validated['start_time']);
        $end = \Carbon\Carbon::parse($validated['end_time']);
        $durationMinutes = $start->diffInMinutes($end);
        if ($durationMinutes < 30) {
            return redirect()->back()
                ->withErrors(['end_time' => __('teacher.minimum_duration_30_minutes')])
                ->withInput();
        }

        $data = $validated;
        $data['courses_id'] = $course->id;
        CourseSchedule::create($data);

        return redirect()->route('course-schedules.index', $course)->with('success', 'Schedule created successfully!');
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

        return view('teacherDashboard.schedules.assigns', compact('course', 'times'));
    }


    public function revoke(accessMeeting $access)
    {
        $access->delete();
        return redirect()->back()->with('success', 'Access removed successfully');
    }

}