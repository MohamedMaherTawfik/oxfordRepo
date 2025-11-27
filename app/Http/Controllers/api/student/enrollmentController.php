<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseInterface;
use App\Interfaces\EnrollmentInterface;

class enrollmentController extends Controller
{
    use apiResponse;
    private $enrollmentRepository;
    private $coursesRepository;
    public function __construct(EnrollmentInterface $enrollmentInterface, CourseInterface $coursesInterface)
    {
        $this->enrollmentRepository = $enrollmentInterface;
        $this->coursesRepository = $coursesInterface;
    }

    public function allEnrollments()
    {
        $enrollments = $this->enrollmentRepository->index(request('courseId'));
        try {
            if (count($enrollments) == 0) {
                return $this->noContent();
            }
            return $this->success($enrollments, __('messages.index_Message'));
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function enrollCourse()
    {
        $course = $this->coursesRepository->getCourse(request('courseId'));
        $enrollment = $this->enrollmentRepository->store($course->id, $course->price);
        try {
            if (!$enrollment) {
                return $this->notFound(__('messages.Error_show_Message'));
            }
            return $this->success($enrollment, __('messages.show_Message'));
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }
}
