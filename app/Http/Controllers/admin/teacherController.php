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
use App\Jobs\ProcessLessonUpload;
use App\Models\assignment_submission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\assignedCertificates;
use App\Models\certificate;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\graduationProject;
use App\Models\lesson;
use App\Models\notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class teacherController extends Controller
{
    private $courseRepository;
    private $lessonRepository;
    private $graduationProjectRepository;
    /**
     * Create a new interface instance.
     *
     * @param CourseInterface $courseRepository
     * @param LessonInterface $lessonRepository
     */
    public function __construct(CourseInterface $courseRepository, LessonInterface $lessonRepository, GraduationProjectInterface $graduationProjectRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
        $this->graduationProjectRepository = $graduationProjectRepository;
    }
    public function dashboard()
    {
        $courses = Courses::with('lessons', 'enrollments')->where('user_id', auth()->user()->id)->get();
        
        // Calculate statistics
        $totalCourses = $courses->count();
        $totalLessons = $courses->sum(function($course) {
            return $course->lessons->count();
        });
        $totalEnrollments = $courses->sum(function($course) {
            return $course->enrollments->count();
        });
        $totalRevenue = $courses->sum(function($course) {
            return $course->enrollments->count() * ($course->price ?? 0);
        });
        
        return view('teacherDashboard.index', compact('courses', 'totalCourses', 'totalLessons', 'totalEnrollments', 'totalRevenue'));
    }

    public function destroyProject(graduationProject $project)
    {
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully!');
    }
    public function showCourse()
    {
        $course = Courses::where('slug', request('slug'))->first();
        $enrollments = Enrollments::where('courses_id', $course->id)->count();
        $price = $enrollments * $course->price;
        return view('teacherDashboard.courses.showCourse', compact('course', 'enrollments', 'price'));
    }

    public function createCourse()
    {
        return view('teacherDashboard.courses.createCourse');
    }

    public function storeCourse(courseRequest $request)
    {
        $fields = $request->validated();
        $this->courseRepository->createCourse($fields);
        return redirect()->route('dashboard')->with('success', 'Course created successfully!');
    }

    public function editCourse()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        return view('teacherDashboard.courses.editCourse', compact('course'));
    }

    public function updateCourse()
    {
        $fields = request()->all();
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        if (request()->hasFile('cover_photo')) {
            $fields['cover_photo'] = request()->file('cover_photo')->store('courses', 'public');
        }
        $fields['slug'] = str_replace(' ', '-', strtolower($fields['title']));
        $this->courseRepository->updateCourse($course->id, $fields);
        return redirect()->route('dashboard')->with('success', 'Course updated successfully!');
    }

    public function deleteCourse()
    {
        $course = $this->courseRepository->getCourse(request('id'));
        $this->courseRepository->deleteCourse($course->id);
        return redirect()->route('dashboard')->with('success', 'Course deleted successfully!');
    }

    public function createLesson()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        return view('teacherDashboard.lessons.createLesson', compact('course'));
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
        lesson::create($validated);

        return redirect()
            ->route('teacher.courses.show', $course->slug)
            ->with('success', 'تم انشاء الدرس ');
    }


    public function showLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return view('teacherDashboard.lessons.showLesson', compact('lesson', 'course'));
    }

    public function editLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return view('teacherDashboard.lessons.editLesson', compact('lesson', 'course'));
    }
    public function updateLesson()
    {
        $fields = request()->all();
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        if (request()->hasFile('image')) {
            $fields['image'] = request()->file('image')->store('lessonsImage', 'public');
        }
        if (request()->hasFile('video')) {
            $fields['video'] = request()->file('video')->store('lessonsVideo', 'public');
        }
        $this->lessonRepository->updateLesson($fields, $lesson->id);
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return redirect()->route('teacher.courses.show', ['slug' => $course->slug])->with('success', 'Lesson updated successfully!');
    }
    public function deleteLesson()
    {
        $lesson = $this->lessonRepository->getLesson(request('id'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        $this->lessonRepository->deleteLesson($lesson->id);
        return redirect()->route('teacher.courses.show', ['slug' => $course->slug])->with('success', 'Lesson deleted successfully!');
    }

    public function showUploadedProject(graduationProject $project)
    {
        $assignments = assignment_submission::where('graduation_project_id', $project->id)->get();

        return view('teacherDashboard.projects.showUploadedProject', compact('project', 'assignments'));
    }

    public function allProjects()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $projects = $this->graduationProjectRepository->getGraduationProjects(request('slug'));
        return view('teacherDashboard.projects.allprojects', compact('projects', 'course'));
    }

    public function createProject()
    {
        return view('teacherDashboard.projects.createProject');
    }

    public function storeProject(projectRequest $request)
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $fields = $request->validated();
        $fields['file'] = request()->file('file')->store('projectsfile', 'public');
        $this->graduationProjectRepository->createGraduationProject($fields, $course->id);
        return redirect()->route('teacher.project.all', ['slug' => request('slug')])->with('success', 'Project created successfully!');
    }

    public function showProject()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $projects = $this->graduationProjectRepository->getGraduationProjects(request('slug'));
        return view('teacherDashboard.projects.showProject', compact('projects', 'course'));
    }

    public function editProject()
    {
        $project = $this->graduationProjectRepository->getGraduationProjectBySlug(request('slug'));
        return view('teacherDashboard.projects.editProject', compact('project'));
    }

    public function updateProject()
    {
        $data = request()->all();
        graduationProject::find(request('id'))->update($data);
        return redirect()->route('teacher.project.show', ['slug' => request('slug')])->with('success', 'Project created successfully!');
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
        return view('teacherDashboard.certificates.index', compact('course'));
    }

    public function createCertificate()
    {
        return view('teacherDashboard.certificates.create', );
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

        return redirect()->route('teacherDashboard.certificates.index', ['slug' => request('slug')])
            ->with('success', 'Certificate created successfully!');
    }

    public function assignCertificate()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        $user = $course->enrollments->pluck('user')->unique()->where('id', request('user_id'))->first();
        $certificates = certificate::where('user_id', auth()->user()->id)
            ->where('courses_id', $course->id)
            ->get();
        return view('teacherDashboard.certificates.assign', compact('course', 'user', 'certificates'));
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
        return redirect()->route('teacherDashboard.certificates.index', ['slug' => request('slug')])
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

    public function evaluate(Request $request, assignment_submission $project)
    {
        $data = $request->except('_token');
        $project->update($data);
        return redirect()->back()->with('success', 'تم تقييم المشروع بنجاح');
    }

    /**
     * Display all courses for the teacher
     */
    public function allCourses()
    {
        // Ensure we only get courses for the authenticated teacher
        $teacherId = auth()->user()->id;
        
        $courses = Courses::with(['category', 'lessons', 'enrollments'])
            ->where('user_id', $teacherId)
            ->withCount(['lessons', 'enrollments'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Add counts to each course and ensure ownership
        $courses->getCollection()->transform(function ($course) use ($teacherId) {
            // Double check ownership
            if ($course->user_id != $teacherId) {
                return null;
            }
            $course->enrollments_count = $course->enrollments->count();
            $course->lessons_count = $course->lessons->count();
            return $course;
        })->filter();

        return view('teacherDashboard.courses.allCourses', compact('courses'));
    }
}
