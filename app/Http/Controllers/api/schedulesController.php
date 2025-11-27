<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\student\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseSchedule;
use Illuminate\Http\Request;

class schedulesController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $data = Courses::with('courseSchedules')->where('id', request('id'))->get();
        return $this->success($data, 'Successfully Fetched');
    }

    public function show()
    {
        $schedule = CourseSchedule::where('id', request('id'))->first();
        if (!$schedule) {
            return $this->notFound('Schedule not found');
        }
        return $this->success($schedule, 'Successfully Fetched');
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['courses_id'] = request('id');
        $schedule = CourseSchedule::create($data);
        return $this->success($schedule, 'Successfully Created');

    }

    public function update()
    {
        $data = request()->all();
        $schedule = CourseSchedule::where('id', request('id'))->first();
        if (!$schedule) {
            return $this->notFound('Schedule not found');
        }

        $schedule->update($data);
        return $this->success($schedule, 'Successfully Updated');
    }

    public function destroy()
    {
        $schedule = CourseSchedule::where('id', request('id'))->first();
        if (!$schedule) {
            return $this->notFound('Schedule not found');
        }
        $schedule->delete();
        return $this->success($schedule, 'Successfully Deleted');
    }
}