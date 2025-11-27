<?php

namespace App\Http\Controllers\diploma;

use App\Http\Controllers\Controller;
use App\Models\CourseSchedule;
use App\Models\Diplomas;
use Illuminate\Http\Request;

class diplomaScheduleController extends Controller
{
    public function index(Diplomas $diploma)
    {
        $diploma->load('courseSchedule');
        return view('admin.diplomas.schedule.index', compact('diploma'));
    }

    public function store(Request $request, Diplomas $diploma)
    {
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        CourseSchedule::create([
            'diplomas_id' => $diploma->id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'Schedule Created');
    }

    public function update(Request $request, Diplomas $diploma)
    {
        $request->validate([
            'schedule_id' => 'required',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = $diploma->courseSchedule()->findOrFail($request->schedule_id);

        $schedule->update([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'Schedule Updated');
    }

    public function delete(Request $request, Diplomas $diploma)
    {
        $schedule = $diploma->courseSchedule()->findOrFail($request->schedule_id);
        $schedule->delete();

        return back()->with('success', 'Schedule Deleted');
    }
}