<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\api\student\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseSchedule;
use App\Models\times;
use App\Models\User;
use Illuminate\Http\Request;

class timesController extends Controller
{
    use apiResponse;
    public function index()
    {
        $courseSchedules = CourseSchedule::where('id', request('id'))->first();
        $times = times::where('course_schedule_id', $courseSchedules->id)->pluck('user_id');
        $users = User::whereIn('id', $times)->get();
        return $this->success($users, 'Successfully Fetched');
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