<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\courseRequest;
use App\Http\Requests\NotifyCourseRequest;
use App\Interfaces\CourseInterface;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use apiResponse;
    private $courseRepository;

    public function __construct(CourseInterface $coursesInterface)
    {
        $this->courseRepository = $coursesInterface;
    }

    public function allCourses()
    {
        $courses = $this->courseRepository->allCoursesPaginated();
        try {
            if (count($courses) == 0) {
                return $this->noContent();
            }
            return $this->success($courses, __('messages.index_Message'));
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function mycourses()
    {
        $user = currentUser();
        $courses = Courses::where('user_id', $user->id)->paginate(5);
        try {
            if (count($courses) == 0) {
                return $this->success($courses, 'No courses found for this user');
            }
            return $this->success($courses, __('messages.index_Message'));
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function EnrolledCourses()
    {
        $user = currentUser();
        $enrollments = Enrollments::where('user_id', $user->id)->where('enrolled', 'yes')->pluck('courses_id');
        $courses = Courses::whereIn('id', $enrollments)->paginate(5);

        try {
            if (count($courses) == 0) {
                return $this->success($courses, 'No courses Enrollment found for this user');
            }
            return $this->success($courses, 'Enrollments fetched successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }
    public function courseDetail()
    {
        $course = $this->courseRepository->getCourse(request('id'));
        $enrollments = Enrollments::where('user_id', Auth::guard('api')->user()->id)->where('courses_id', $course->id)->get();
        try {
            if (!$course) {
                return $this->notFound('no course found');
            }
            if (count($enrollments) > 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'single Course Fetched Successfully',
                    'data' => [
                        'course' => $course->load('zoomMeetings'),
                        'enrolled' => true,
                    ]
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'single Course Fetched Successfully',
                    'data' => [
                        'course' => $course->load('zoomMeetings'),
                        'enrolled' => False,
                    ]
                ], 200);
            }
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function createCourse(courseRequest $courseRequest)
    {
        $fields = $courseRequest->validated();
        try {
            $course = $this->courseRepository->createCourseApi($fields);
            return $this->success($course, 'Course created Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }

    }

    public function updateCourse()
    {
        $fields = request()->all();
        $course = $this->courseRepository->updateCourseApi(request('id'), $fields);
        if (!$course) {
            return $this->serverError('not updated');
        }
        return $this->success($course, 'Updated Course');
    }

    public function deleteCourse()
    {
        $this->courseRepository->deleteCourse(request('id'));
        return $this->noContent();
    }

    public function searchCourses()
    {
        $data = request()->all();

        $courses = Courses::query();

        if ($data['name']) {
            $courses->where('title', 'like', '%' . $data['name'] . '%');
        }

        if ($data['min'] !== null) {
            $courses->where('price', '>=', $data['min']);
        }

        if ($data['max'] !== null) {
            $courses->where('price', '<=', $data['max']);
        }

        $results = $courses->get();

        return response()->json([
            'status' => true,
            'data' => $results
        ]);
    }
    public function sendNotification(NotifyCourseRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = Auth::guard('api')->id();
        $enrollments = Enrollments::where('courses_id', $data['course_id'])->get();
        $notify = null;
        unset($data['course_id']);
        foreach ($enrollments as $enrollment) {
            $data['reciever_id'] = $enrollment->user_id;
            $notify = notification::create($data);
        }
        return response()->json(['message' => 'Notification sent successfully.', 'data' => $notify]);
    }
}