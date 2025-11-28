<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\api\student\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseSchedule;
use App\Models\times;
use Illuminate\Http\Request;

class timesController extends Controller
{
    use apiResponse;
    public function index()
    {
        $courseSchedules = CourseSchedule::with('times')->where('id', request('id'))->first();
        return $this->success($courseSchedules, 'Successfully Fetched');
    }

    public function create()
    {
        $data = request()->all();
        $schedule = CourseSchedule::where('id', request('id'))->first();
        if (!$schedule) {
            return $this->notFound('schedule not found');
        }
        $data['user_id'] = auth()->user()->id;
        $data['course_schedule_id'] = $schedule->id;
        $data['day'] = $schedule->day;
        $data['time'] = $schedule->start_time . '-' . $schedule->end_time;
        $time = times::create($data);
        return $this->success($time, 'Successfully Created');
    }
}