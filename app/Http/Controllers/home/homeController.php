<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\commentRequest;
use App\Interfaces\CategoryInterface;
use App\Interfaces\CourseInterface;
use App\Interfaces\EnrollmentInterface;
use App\Interfaces\GraduationProjectInterface;
use App\Interfaces\LessonInterface;
use App\Interfaces\ReviewsInterface;
use App\Models\assignment_submission;
use App\Models\categories;
use App\Models\comments;
use App\Models\Courses;
use App\Models\CourseSchedule;
use App\Models\Enrollments;
use App\Models\footer;
use App\Models\graduationProject;
use App\Models\homepage;
use App\Models\lesson;
use App\Models\quizes;
use App\Models\Result;
use App\Models\studentReviews;
use App\Models\times;
use App\Models\visaenable;
use App\Models\whyChooseUs;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class homeController extends Controller
{
    private $coursesRepository;
    private $categoreyrepository;
    private $enrollmentRepository;
    private $lessonRepository;
    private $reviewRepository;
    private $projectRepository;
    public function __construct(CourseInterface $coursesRepository, CategoryInterface $categoreyInterface, EnrollmentInterface $enrollmentInterface, LessonInterface $lessonInterface, ReviewsInterface $reviewsInterface, GraduationProjectInterface $graduationProject)
    {

        $this->coursesRepository = $coursesRepository;
        $this->categoreyrepository = $categoreyInterface;
        $this->enrollmentRepository = $enrollmentInterface;
        $this->lessonRepository = $lessonInterface;
        $this->reviewRepository = $reviewsInterface;
        $this->projectRepository = $graduationProject;
    }
    public function home()
    {
        return view('welcome');
    }
    function getYoutubeId($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return isset($match[1]) ? $match[1] : null;
    }
    public function index()
    {
        $courses = $this->coursesRepository->allCourses();
        $homepage = homepage::first();

        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }

        $why = whyChooseUs::all();
        $contacts = studentReviews::where('seen', 1)->get()->skip(1);
        $coursesJs = $courses->map(function ($course) {
            return [
                'id' => $course->id,
                'slug' => $course->slug,
                'duration' => $course->duration,
                'title' => $course->title,
                'description' => $course->description ?? 'وصف الكورس سيظهر هنا...',
                'price' => $course->price ?? 0,
                'image' => asset('storage/' . $course->cover_photo) ?? 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=', // الرابط الجاهز
                'category' => $course->category ? ['name' => $course->category->name] : ['name' => 'عام'],
                'user' => [
                    'name' => $course->user ? $course->user->name : 'مستخدم',
                    'photo' => $course->user ? asset('storage/' . $course->user->photo) : asset('images/default.jpg'),
                ],
                'reviews' => [
                    'rating' => $course->review->avg('rating') ?? 0
                ],
            ];
        })->toArray();

        return view('home.index', compact('courses', 'homepage', 'coursesJs', 'why', 'contacts'));
    }
    public function showCourse()
    {
        $visaenables = visaenable::first();
        
        // إرجاع قيم افتراضية إذا لم تكن هناك بيانات
        if (!$visaenables) {
            $visaenables = (object) [
                'visa_enable' => 1,
                'cash_enable' => 1,
            ];
        }
        
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        
        // تحميل العلاقات مع فحص null
        if ($course) {
            $course->load(['user', 'user.courses', 'category']);
        }
        
        $enrollmentUserIds = Enrollments::where('enrolled', 'yes')->where('courses_id', $course->id)->pluck('user_id');
        if (Auth::check()) {
            if ($enrollmentUserIds->contains(Auth::user()->id)) {
                return redirect()->route('myCourses');
            }
        }
        $schedule = CourseSchedule::where('courses_id', $course->id)->get();
        // dd($schedule);
        $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
            ? asset('storage/' . $course->cover_photo)
            : asset('images/coursePlace.png');
        return view('home.courses.show', compact('course', 'schedule', 'visaenables'));
    }

    public function submitproject(Request $request, graduationProject $project)
    {
        $data = $request->except('_token');
        if ($request->hasFile('project_file')) {
            $data['project_file'] = request()->file('project_file')->store('projects', 'public');
        }
        assignment_submission::create([
            'user_id' => auth()->id(),
            'graduation_project_id' => $project->id,
            'file' => $data['project_file']
        ]);
        return redirect()->back()->with('success', 'تم إرسال المشروع بنجاح');
    }

    // public function showCategorey()
    // {
    //     $category = $this->categoreyrepository->getCategoryBySlug(request('slug'));
    //     foreach ($category->courses as $course) {
    //         $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
    //             ? asset('storage/' . $course->cover_photo)
    //             : asset('images/coursePlace.png');
    //     }
    //     return view('home.categorey.show', compact('category'));
    // }

    public function profile()
    {
        $user = Auth::user()->load('applyTeacher', 'course');

        return view('home.profile', compact('user'));
    }

    public function enrollment()
    {

        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $this->enrollmentRepository->store($course->id, $course->price);
        return redirect('/');
    }

    public function enrolledCourses()
    {
        $courseIds = Enrollments::where('user_id', Auth::user()->id)->where('enrolled', 'yes')
            ->pluck('courses_id');
        $courses = Courses::whereIn('id', $courseIds)->get();
        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('home.myCourses', compact('courses'));
    }

    public function enrolledCourse()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $zoommeeting = ZoomMeeting::where('courses_id', $course->id)
            ->orderBy('id', 'desc')
            ->first();
        $relatedCourses = Courses::where('categorey_id', $course->categorey_id)->take(3)->get();
        $projects = $this->projectRepository->getGraduationProjects($course->slug);
        $quizzes = quizes::where('courses_id', $course->id)->get();
        $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
            ? asset('storage/' . $course->cover_photo)
            : asset('images/coursePlace.png');

        foreach ($relatedCourses as $item) {
            $item->cover_photo_url = $item->cover_photo && Storage::disk('public')->exists($item->cover_photo)
                ? asset('storage/' . $item->cover_photo)
                : asset('images/coursePlace.png');
        }

        foreach ($course->lessons as $lesson) {
            $lesson->cover_photo_url = $lesson->cover_photo && Storage::disk('public')->exists($lesson->cover_photo)
                ? asset('storage/' . $lesson->image)
                : asset('images/lessonHolder.jpg');
        }

        $result = Result::where('user_id', Auth::user()->id)->get();
        $schedules = CourseSchedule::where('courses_id', $course->id)->pluck('id');
        $times = times::whereIn('course_schedule_id', $schedules)->where('user_id', Auth::user()->id)->get();
        $assignemtns = assignment_submission::where('user_id', Auth::user()->id)->get();

        return view('home.courses.enrolledCourse', compact('course', 'times', 'relatedCourses', 'projects', 'quizzes', 'zoommeeting', 'result', 'assignemtns'));
    }

    public function showLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        return view('home.courses.lessons.show', compact('lesson'));
    }

    public function courseReview()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $this->reviewRepository->makeReview(request('rating'), $course->id);
        return redirect()->route('myCourse', ['slug' => $course->slug]);
    }

    public function allCourses()
    {
        $courses = $this->coursesRepository->allCourses()->reverse();
        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('home.courses.allCourses', compact('courses'));
    }

    public function fromSearch()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        if ($course) {

            return view('home.courses.show', compact('course'));
        }
        return view('home.courses.notFound');
    }

    public function about()
    {
        return view('home.inforamtions.aboutUs');
    }

    public function contact()
    {
        $contact = studentReviews::first();
        $footer = footer::first();
        
        // إرجاع قيم افتراضية إذا لم تكن هناك بيانات
        if (!$contact) {
            $contact = (object) [
                'address' => '',
                'phone' => '',
                'email' => '',
            ];
        }
        
        if (!$footer) {
            $footer = (object) [
                'facebook' => null,
                'x' => null,
                'telegram' => null,
                'instgram' => null,
            ];
        }
        
        return view('home.inforamtions.contactUs', compact('contact', 'footer'));
    }
    public function storecontact(Request $request)
    {
        $data = $request->except('_token');
        studentReviews::create($data);
        return redirect()->back()->with('success', 'تم إضافة الرسالة بنجاح');
    }

    public function start()
    {
        $quiz = quizes::where('slug', request('quiz'))->firstOrFail();

        $existing = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.quiz.result', $quiz->slug)
                ->with('error', 'You already attempted this quiz.');
        }

        $quiz->load('questions.options');

        return view('home.quiz.start', compact('quiz'));
    }


    public function submitQuiz(Request $request, $slug)
    {
        $quiz = quizes::where('slug', $slug)->firstOrFail();

        $existing = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.quiz.result', $quiz->slug)
                ->with('error', 'You already submitted this quiz.');
        }

        $answers = $request->input('answers', []);
        $score = 0;

        foreach ($quiz->questions as $question) {
            $correctOption = $question->options()->where('is_correct', true)->first();
            if (isset($answers[$question->id]) && $answers[$question->id] == $correctOption->id) {
                $score++;
            }
        }

        Result::create([
            'user_id' => auth()->id(),
            'quizes_id' => $quiz->id,
            'score' => $score,
        ]);

        return redirect()->route('student.quiz.result', $quiz->slug)->with('success', 'Quiz submitted successfully!');
    }


    public function exitQuiz($slug)
    {
        $quiz = quizes::where('slug', $slug)->firstOrFail();

        $existing = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.quiz.result', $quiz->slug);
        }

        Result::create([
            'user_id' => auth()->id(),
            'quizes_id' => $quiz->id,
            'score' => 0,
        ]);

        return redirect()->route('student.quiz.result', $quiz->slug)
            ->with('error', 'You exited the quiz. Your score is 0.');
    }


    public function quizResult($slug)
    {
        $quiz = quizes::where('slug', $slug)->firstOrFail();
        $result = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->latest()
            ->first();

        if (!$result) {
            return redirect()->route('student.quiz.show', $quiz->slug)
                ->with('error', 'No result found for this quiz.');
        }

        return view('home.quiz.result', compact('quiz', 'result'));
    }


    public function settingUpdate(Request $request)
    {
        $user = auth()->user();
        // check for photo as file
        if ($request->hasFile('photo')) {
            $photoName = $request->file('photo')->store('users', 'public');
            $user->update([
                'photo' => $photoName,
            ]);
        }
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
        ]);
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // ✅ Update to new password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function storeComment(commentRequest $request, lesson $lesson)
    {
        $validated = $request->validated();
        comments::create([
            'user_id' => auth()->id(),
            'lesson_id' => $lesson->id,
            'comment' => $validated['comment'],
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function speakWithAi()
    {
        return view('home.chat.sepakAi');
    }

    public function send(Request $request)
    {
        $apiKey = env('CHAT_KEY');

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->message]
                    ]
                ]
            ]
        ]);

        $data = $response->json();

        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return response()->json([
                'reply' => $data['candidates'][0]['content']['parts'][0]['text']
            ]);
        }

        return response()->json([
            'error' => $data['error']['message'] ?? 'Unexpected error from Gemini'
        ], 500);
    }

    public function categorey(categories $categorey)
    {
        $categorey->load('courses');
        return view('home.categorey.show', compact('categorey'));
    }
}