<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\courseRequest;
use App\Http\Requests\lessonRequest;
use App\Http\Requests\notifyRequest;
use App\Http\Requests\projectRequest;
use App\Interfaces\CourseInterface;
use App\Interfaces\GraduationProjectInterface;
use App\Interfaces\LessonInterface;
use App\Jobs\UploadLessonToYouTubeJob;
use App\Models\assignedCertificates;
use App\Models\assignment_submission;
use App\Models\certificate;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\graduationProject;
use App\Models\lesson;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminCreateController extends Controller
{
    private $courseRepository;
    private $lessonRepository;
    private $graduationProjectRepository;
    /**
     * Create a new interface instance.
     *
     * @param \App\Interfaces\CourseInterface $courseRepository
     * @param \App\Interfaces\LessonInterface $lessonRepository
     */
    public function __construct(CourseInterface $courseRepository, LessonInterface $lessonRepository, GraduationProjectInterface $graduationProjectRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
        $this->graduationProjectRepository = $graduationProjectRepository;
    }
    public function showCourse()
    {
        $course = Courses::where('slug', request('slug'))->first();
        $enrollments = Enrollments::where('courses_id', $course->id)->count();
        $price = $enrollments * $course->price;
        return view('adminCourse.courses.showCourse', compact('course', 'enrollments', 'price'));
    }


    public function allCourses()
    {
        $courses = Courses::orderBy('created_at', 'desc')->get();
        return view('adminCourse.courses.allCourses', compact('courses'));
    }

    public function createCourse()
    {
        return view('adminCourse.courses.createCourse');
    }

    public function storeCourse(courseRequest $request)
    {
        $fields = $request->validated();
        $this->courseRepository->createCourse($fields);
        return redirect()->route('admin.courses.all')->with('success', 'Course created successfully!');
    }

    public function editCourse()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        return view('adminCourse.courses.editCourse', compact('course'));
    }

    public function editcourseprice(Request $request, Courses $course)
    {
        $data = $request->except('_token');
        $course->update($data);
        return redirect()->back()->with('success', 'Course updated successfully!');
    }

    public function updateCourse()
    {
        $fields = request()->all();
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        if (request()->hasFile('cover_photo')) {
            // Delete old image if exists
            if ($course->cover_photo && \Storage::disk('public')->exists($course->cover_photo)) {
                \Storage::disk('public')->delete($course->cover_photo);
            }
            $fields['cover_photo'] = request()->file('cover_photo')->store('courses', 'public');
        }
        $fields['slug'] = str_replace(' ', '-', strtolower($fields['title']));
        $this->courseRepository->updateCourse($course->id, $fields);
        return redirect()->route('admin.courses.all')->with('success', 'Course updated successfully!');
    }

    public function deleteCourse()
    {
        $course = $this->courseRepository->getCourse(request('id'));
        $this->courseRepository->deleteCourse($course->id);
        return redirect()->route('admin.courses.all')->with('success', 'Course deleted successfully!');
    }

    public function createLesson()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        return view('adminCourse.lessons.createLesson', compact('course'));
    }

    public function storeLesson(LessonRequest $request)
    {
        $course = Courses::where('slug', request('slug'))->firstOrFail();
        $validated = $request->validated();

        $validated['courses_id'] = $course->id;
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('lessonsImage', 'public');
        }
        if ($request->hasFile('video_url')) {
            $validated['video_url'] = $request->file('video_url')->store('lessonsvideo', 'public');
        }
        $lesson = lesson::create($validated);

        return redirect()
            ->route('admin.courses.show', $course->slug)
            ->with('success', 'تم انشاء الدرس ');
    }


    public function showLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return view('adminCourse.lessons.showLesson', compact('lesson', 'course'));
    }

    public function editLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return view('adminCourse.lessons.editLesson', compact('lesson', 'course'));
    }
    public function updateLesson()
    {
        $fields = request()->all();
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        if (request()->hasFile('image')) {
            // Delete old image if exists
            if ($lesson->image && \Storage::disk('public')->exists($lesson->image)) {
                \Storage::disk('public')->delete($lesson->image);
            }
            $fields['image'] = request()->file('image')->store('lessonsImage', 'public');
        }
        if (request()->hasFile('video')) {
            // Delete old video if exists
            if ($lesson->video_url && \Storage::disk('public')->exists($lesson->video_url)) {
                \Storage::disk('public')->delete($lesson->video_url);
            }
            $fields['video'] = request()->file('video')->store('lessonsVideo', 'public');
        }
        $this->lessonRepository->updateLesson($fields, $lesson->id);
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return redirect()->route('admin.courses.show', ['slug' => $course->slug])->with('success', 'Lesson updated successfully!');
    }
    public function deleteLesson()
    {
        $lesson = $this->lessonRepository->getLesson(request('id'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        $this->lessonRepository->deleteLesson($lesson->id);
        return redirect()->route('admin.courses.show', ['slug' => $course->slug])->with('success', 'Lesson deleted successfully!');
    }

    public function showUploadedProject(graduationProject $project)
    {
        $assignments = assignment_submission::where('graduation_project_id', $project->id)->get();

        return view('adminCourse.projects.showUploadedProject', compact('project', 'assignments'));
    }
    public function allProjects()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $projects = $this->graduationProjectRepository->getGraduationProjects(request('slug'));
        return view('adminCourse.projects.allprojects', compact('projects', 'course'));
    }

    public function evaluate(Request $request, assignment_submission $project)
    {
        $data = $request->except('_token');
        $project->update($data);
        return redirect()->back()->with('success', 'تم تقييم المشروع بنجاح');
    }

    public function createProject()
    {
        return view('adminCourse.projects.createProject');
    }

    public function storeProject(projectRequest $request)
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $fields = $request->validated();
        $fields['file'] = request()->file('file')->store('projectsfile', 'public');
        $this->graduationProjectRepository->createGraduationProject($fields, $course->id);
        return redirect()->route('admin.project.all', ['slug' => request('slug')])->with('success', 'Project created successfully!');
    }

    public function destroyProject(graduationProject $project)
    {
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully!');
    }

    public function showProject()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $projects = $this->graduationProjectRepository->getGraduationProjects(request('slug'));
        return view('adminCourse.projects.showProject', compact('projects', 'course'));
    }

    public function editProject()
    {
        $project = $this->graduationProjectRepository->getGraduationProjectBySlug(request('slug'));
        return view('adminCourse.projects.editProject', compact('project'));
    }

    public function updateProject()
    {
        $data = request()->all();
        graduationProject::find(request('id'))->update($data);
        return redirect()->route('admin.project.show', ['slug' => request('slug')])->with('success', 'Project created successfully!');
    }

    public function deleteProject()
    {
        graduationProject::find(request('id'))->delete();
        return redirect()->back();
    }

    public function certificates()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));

        $course->enrollments->pluck('user')->unique();
        return view('adminCourse.certificates.index', compact('course'));
    }

    public function createCertificate()
    {
        return view('adminCourse.certificates.create', );
    }

    public function storeCertificate()
    {
        $fields = request()->validate([
            'certificate' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if (request()->hasFile('file')) {
            $fields['file'] = request()->file('file')->store('certificates', 'public');
        }

        $fields['status'] = 'not_assigned';
        $fields['user_id'] = request('id');
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $fields['courses_id'] = $course->id;
        $fields['slug'] = str_replace(' ', '-', strtolower($fields['certificate'])) . '-' . time();

        certificate::create($fields);

        return redirect()->route('adminCourse.certificates.index', ['slug' => request('slug')])
            ->with('success', 'Certificate created successfully!');
    }

    public function assignCertificate()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $user = $course->enrollments->pluck('user')->unique()->where('id', request('user_id'))->first();
        $certificates = certificate::where('user_id', auth()->user()->id)
            ->where('courses_id', $course->id)
            ->get();
        return view('adminCourse.certificates.assign', compact('course', 'user', 'certificates'));
    }

    public function storeCertificateUser()
    {
        $fields = request()->validate([
            'certificate' => 'required|exists:certificates,id',
        ]);
        assignedCertificates::create([
            'user_id' => request('user_id'),
            'certificate_id' => $fields['certificate'],
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);
        return redirect()->route('adminCourse.certificates.index', ['slug' => request('slug')])
            ->with('success', 'Certificate assigned successfully!');
    }

    public function sendNotification(notifyRequest $request, Courses $course)
    {
        $validated = $request->validated();
        $validated['sender_id'] = Auth::user()->id;
        $enrollments = $course->enrollments;
        foreach ($enrollments as $enrollment) {
            $validated['reciever_id'] = $enrollment->user_id;
            notification::create($validated);
        }
        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    public function myCourses()
    {
        $courses = Courses::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('adminCourse.courses.myCourses', compact('courses'));
    }
}
