<?php

use App\Http\Controllers\admin\AdminCreateController;
use App\Http\Controllers\admin\diplomaCategoreyController;
use App\Http\Controllers\admin\diplomaController;
use App\Http\Controllers\admin\diplomaRequestsController;
use App\Http\Controllers\admin\FooterController;
use App\Http\Controllers\admin\payment\adminpaymentController;
use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\diploma\diplomaLessonController;
use App\Http\Controllers\diploma\diplomaMeetingController;
use App\Http\Controllers\diploma\diplomaScheduleController;
use App\Http\Controllers\gate\GateController;
use App\Http\Controllers\home\ClickPayController;
use App\Http\Controllers\home\GoogleAuthController;
use App\Http\Controllers\home\homeController;
use App\Http\Controllers\home\notificationCotroller;
use App\Http\Controllers\admin\QuizController;
use App\Http\Controllers\home\zoomController;
use App\Http\Controllers\teacher\AdminZoomController;
use App\Http\Controllers\teacher\certificateControllerAdmin;
use App\Http\Controllers\teacher\CourseScheduleController;
use App\Http\Middleware\Teacher;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SuperAdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Middleware\CheckAdmin;


Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'signUp')->name('register');
    Route::post('/register', 'register')->name('signup');
    Route::get('/teacher', 'teacherRegister')->name('teacher');
    Route::post('/teacher', 'teacher')->name('teacher');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'signin')->name('signin');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/reset-password', 'resetPage')->name('reset.password')->middleware('auth');
    Route::post('/reset-password', 'updatePassword')->name('password.reset')->middleware('auth');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::group([], function () {
    Route::get('/', [homeController::class, 'index'])->name('home');
    Route::get('/profile', [homeController::class, 'profile'])->name('profile')->middleware('auth');
    Route::post('/profile', [homeController::class, 'settingUpdate'])->name('settings.update')->middleware('auth');
    Route::post('/profile/password', [homeController::class, 'passwordUpdate'])->name('password.update')->middleware('auth');
    Route::get('/about', [homeController::class, 'about'])->name('about');
    Route::get('/contact', [homeController::class, 'contact'])->name('contact');
    Route::post('/contact/send', [homeController::class, 'storecontact'])->name('contact.store');
    Route::get('/courses', [homeController::class, 'courses'])->name('courses');
    Route::get('/course/{slug}', [homeController::class, 'showCourse'])->name('course.show');
    Route::post('/course/{slug}', [homeController::class, 'enrollment'])->name('enrollment')->middleware('auth');
    Route::get('/categorey/{categorey}', [homeController::class, 'categorey'])->name('categories.show');
    Route::get('/mycourses', [homeController::class, 'enrolledCourses'])->name('myCourses');
    Route::get('/mycourse/{slug}', [homeController::class, 'enrolledCourse'])->name('myCourse');
    Route::post('/mycourse/{slug}', [homeController::class, 'courseReview'])->name('course.review');
    Route::post('/mycourse/{project}/project', [homeController::class, 'submitproject'])->name('course.project.submit');
    Route::get('/mycourse/lesson/{slug}', [homeController::class, 'showLesson'])->name('lesson.show');
    Route::post('/mycourse/lesson/{lesson}', [homeController::class, 'storeComment'])->name('comment.store');
    Route::get('/allCourses', [homeController::class, 'allCourses'])->name('courses.all');
    Route::get('/student/quizzes/{quiz}/start', [homeController::class, 'start'])
        ->name('student.quiz.show');
    Route::post('/student/quizzes/{quiz}/submit', [homeController::class, 'submitQuiz'])
        ->name('student.quiz.submit')
        ->middleware('auth');
    Route::post('/student/quizzes/{quiz}/exit', [homeController::class, 'exitQuiz'])->name('student.quiz.exit')->middleware('auth');
    Route::get('/student/quizzes/{quiz}/result', [homeController::class, 'quizResult'])->name('student.quiz.result')->middleware('auth');
    Route::get('/notification', [notificationCotroller::class, 'index'])->name('notifications.index')->middleware('auth');
    Route::get('/admin/chat', [homeController::class, 'speakWithAi'])->name('chat');
    // Chat API route - moved from api.php to avoid api_key middleware
    Route::post('/api/chat', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');

    Route::get('/pay/later/{course}', [ClickPayController::class, 'payLater'])->name('pay.later')->middleware('auth');
    Route::get('/pay/later/{course}/auth', [ClickPayController::class, 'payLaterauth'])->name('pay.later.auth')->middleware('auth');
    Route::get('/pay-later-redirect/{course}', function ($course) {
        return view('payments.auto-submit', compact('course'));
    })->name('pay.later.redirect');
});



Route::group([
    'middleware' => ['auth', CheckAdmin::class],
], function () {
    Route::group([
        'middleware' => function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        }
    ], function () {
        Route::resource('admin/staff', \App\Http\Controllers\admin\StaffController::class)->names([
            'index' => 'admin.staff.index',
            'create' => 'admin.staff.create',
            'store' => 'admin.staff.store',
            'show' => 'admin.staff.show',
            'edit' => 'admin.staff.edit',
            'update' => 'admin.staff.update',
            'destroy' => 'admin.staff.destroy',
        ]);
    });

    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
        Route::get('/admin/users', 'users')->name('admin.users');
        Route::get('/admin/teachers', 'teachers')->name('admin.teachers');
        Route::post('/admin/teachers/notify', 'sendNotification')->name('admin.teachers.notify');
        Route::get('/admin/users/show/{user}', 'showUser')->name('admin.users.show');
        Route::get('/admin/users/create', 'createUser')->name('admin.users.create');
        Route::post('/admin/users/create', 'storeUser')->name('admin.users.store');
        Route::get('/admin/users/edit/{id}', 'editUser')->name('admin.users.edit');
        Route::post('/admin/users/edit/{id}', 'updateUser')->name('admin.users.update');
        Route::delete('/admin/users/delete/{id}', 'deleteUser')->name('admin.users.delete');
        Route::get('/admin/applies/pending', 'pending')->name('admin.applies');
        Route::get('/admin/applies/accepted', 'accepted')->name('admin.accepts');
        Route::get('/admin/applies/rejected', 'rejected')->name('admin.rejects');
        Route::get('/admin/applies/accept/{id}', 'acceptApply')->name('admin.applies.accept');
        Route::post('/admin/applies/reject/{id}', 'rejectApply')->name('admin.applies.reject');
        Route::post('/admin/applies/mail/{id}', 'mailApply')->name('admin.applies.mail');
        Route::get('/admin/courses/{course}/edit', 'editCourse')->name('admin.course.edit');
        Route::post('/admin/courses/{course}/edit', 'updateCourse')->name('admin.course.update');
        Route::delete('/admin/courses/delete/{course}', 'deleteCourse')->name('admin.courses.delete');
        Route::get('/admin/categories', 'categories')->name('admin.categories');
        Route::get('/admin/categories/create', 'createCategory')->name('admin.categories.create');
        Route::post('/admin/categories/create', 'storeCategory')->name('admin.categories.store');
        Route::get('/admin/categories/edit/{id}', 'editCategory')->name('admin.categories.edit');
        Route::post('/admin/categories/edit/{id}', 'updateCategory')->name('admin.categories.update');
        Route::delete('/admin/categories/delete/{id}', 'deleteCategory')->name('admin.categories.delete');
        Route::get('/admin/home', 'home')->name('admin.home');
        Route::post('/admin/home', 'upload')->name('admin.home.upload');
        Route::get('/admin/why', 'why')->name('admin.why');
        Route::get('/admin/contact', 'contact')->name('admin.contact');
        Route::post('/admin/contact/update/{contact}/first', 'editFirst')->name('admin.contact.first');
        Route::post('/admin/contact/update/{contact}', 'updatecontact')->name('admin.contact.update');
        Route::post('/admin/why', 'whystore')->name('admin.why.store');
        Route::delete('/admin/why/delete/{why}', 'whydelete')->name('admin.why.delete');
        Route::post('/admin/home/store', 'store')->name('admin.home.store');
        Route::delete('/admin/home/delete', 'delete')->name('admin.home.delete');

    });
});

Route::group([
    'middleware' => ['auth', CheckAdmin::class],
], function () {
    Route::controller(FooterController::class)->group(function () {
        Route::get('/admin/footers', 'footers')->name('admin.footers');
        Route::post('/admin/footers', 'storeFooter')->name('admin.footers.store');
        Route::get('/admin/footers/edit', 'editFooter')->name('admin.footers.edit');
        Route::post('/admin/footers/edit', 'updateFooter')->name('admin.footers.update');
    });
});

Route::prefix('dashboard')->middleware(['auth', Teacher::class])->group(function () {
    Route::prefix('quizzes')->group(function () {
        Route::get('/{course}/all', [QuizController::class, 'index'])->name('teacherDashboard.quizzes.index');
        Route::get('/{course}/create', [QuizController::class, 'create'])->name('teacherDashboard.quizzes.create');
        Route::post('/{course}/', [QuizController::class, 'store'])->name('teacherDashboard.quizzes.store');
        Route::get('/{course}/{quiz}', [QuizController::class, 'show'])->name('teacherDashboard.quizzes.show');
        Route::get('/{course}/{quiz}/edit', [QuizController::class, 'edit'])->name('teacherDashboard.quizzes.edit');
        Route::put('/{course}/{quiz}', [QuizController::class, 'update'])->name('teacherDashboard.quizzes.update');
        Route::delete('/{course}/{quiz}', [QuizController::class, 'destroy'])->name('teacherDashboard.quizzes.destroy');
    });

    Route::prefix('')->group(function () {
        Route::get('/{course}/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('/{course}/quizzes/{quiz}/questions/create', [QuestionController::class, 'store'])->name('questions.store');
        Route::delete('/{course}/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    });

});


Route::group([
    'middleware' => ['auth', CheckAdmin::class],
], function () {
    Route::controller(AdminCreateController::class)->group(function () {
        Route::get('/admin/courses/create/admin', 'createCourse')->name('admin.courses.create');
        Route::post('/admin/courses/create/admin', 'storeCourse')->name('admin.courses.store');
        Route::get('/admin/courses/edit/{slug}/admin', 'editCourse')->name('admin.courses.edit');
        Route::post('/admin/courses/edit/{slug}/admin', 'updateCourse')->name('admin.courses.update');
        Route::post('/admin/courses/edit/{course}/admin/price', 'editcourseprice')->name('admin.courses.adminPrice');
        Route::delete('/admin/courses/delete/{id}/admin', 'deleteCourse')->name('admin.courses.delete');
        Route::get('/admin/courses/{slug}/admin', 'showCourse')->name('admin.courses.show');
        Route::post('/admin/notification/{course}/admin', 'sendNotification')->name('admin.courses.notify');
        Route::get('/admin/courses/lessons/create/{slug}/admin', 'createLesson')->name('admin.lessons.create');
        Route::post('/admin/courses/lessons/create/{slug}/admin', 'storeLesson')->name('admin.lessons.store');
        Route::get('/admin/courses/lessons/edit/{slug}/admin', 'editLesson')->name('admin.lessons.edit');
        Route::post('/admin/courses/lessons/edit/{slug}/admin', 'updateLesson')->name('admin.lessons.update');
        Route::delete('/admin/courses/lessons/delete/{id}/admin', 'deleteLesson')->name('admin.lessons.delete');
        Route::get('/admin/courses/lessons/{slug}/admin', 'showLesson')->name('admin.lessons.show');
        Route::get('/admin/courses/lessons/quiz/create/{slug}/admin', 'createQuiz')->name('admin.quiz.create');
        Route::post('/admin/courses/quiz/create/{slug}/admin', 'storeQuiz')->name('admin.quiz.store');
        Route::get('/admin/courses/all/admin/courses', 'allCourses')->name('admin.courses.all');
        Route::get('/admin/courses/all/admin/courses/me', 'myCourses')->name(name: 'admin.courses.me');
        Route::post('/admin/courses/quiz/{id}/admin', 'deleteQuiz')->name('admin.quiz.delete');
        Route::get('/admin/courses/project/all/{slug}/admin', 'allProjects')->name('admin.project.all');
        Route::get('/admin/courses/project/create/{slug}/admin', 'createProject')->name('admin.project.create');
        Route::post('/admin/courses/project/create/{slug}/admin', 'storeProject')->name('admin.project.store');
        Route::get('/admin/courses/project/edit/{slug}/admin', 'editProject')->name('admin.project.edit');
        Route::post('/admin/courses/project/edit/{id}/admin', 'updateProject')->name('admin.project.update');
        Route::get('/admin/courses/project/show/{project}', 'showUploadedProject')->name('admin.project.show');
        Route::post('/admin/courses/project/show/{project}/evaluate', 'evaluate')->name('admin.assignments.evaluate');
        Route::delete('/admin/courses/project/show/{project}/delete', 'destroyProject')->name('admin.projects.destroy');
        Route::delete('/admin/courses/project/{id}/admin', 'deleteProject')->name('admin.project.delete');
        Route::get('/admin/courses/{slug}/certificates/admin', 'certificates')->name('admin.certificates.index');
        Route::get('/admin/courses/{slug}/certificates/{id}/create/admin', 'createCertificate')->name('admin.certificates.create');
        Route::post('/admin/courses/{slug}/certificates/{id}/create/admin', 'storeCertificate')->name('admin.certificates.store');
        Route::get('/admin/courses/{slug}/certificates/assign/{user_id}/admin', 'assignCertificate')->name('admin.certificates.assign');
        Route::post('/admin/courses/{slug}/certificates/assign/{user_id}/admin', 'storeCertificateUser')->name('admin.certificatesUser.store');
        Route::get('/admin/courses/{slug}/certificates/download/{user_id}/admin', 'downloadCertificate')->name('admin.certificates.download');

        Route::get('/admin/course-schedules/{course}/admin', [certificateControllerAdmin::class, 'index'])->name('admin.course-schedules.index');
        Route::get('/admin/course-schedules/{course}/{day}/{time}/admin/students/acess/go/students', [certificateControllerAdmin::class, 'students'])->name('admin.course-schedules.students');
        // Route::post('/admin/course-schedules/{course}/{day}/admin/students/acess', [certificateControllerAdmin::class, 'access'])->name('admin.course-schedules.students');
        Route::get('/admin/course-schedules/create/{course}/{day}/admin', [certificateControllerAdmin::class, 'create'])->name('admin.course-schedules.create');
        Route::post('/admin/course-schedules/create/{course}/admin', [certificateControllerAdmin::class, 'store'])->name('admin.course-schedules.store');
        Route::delete('/admin/course-schedules/{courseSchedule}/delete/admin', [certificateControllerAdmin::class, 'destroy'])->name('admin.course-schedules.destroy');
        Route::delete(
            '/admin/course-schedules/access/{access}',
            [certificateControllerAdmin::class, 'revoke']
        )->name('admin.course-schedules.students.revoke');


        Route::get('/admin/diplomas/categoreis', [diplomaCategoreyController::class, 'index'])->name('diplomas.categorey.index');
        Route::delete('/admin/diplomas/categoreis/delete/{categorey}', [diplomaCategoreyController::class, 'delete'])->name('diplomas.categorey.delete');
        Route::post('/admin/diplomas/categoreis/create/{categorey}', [diplomaCategoreyController::class, 'create'])->name('diplomas.categorey.create');
        Route::post('/admin/diplomas/categoreis/update/{categorey}', [diplomaCategoreyController::class, 'update'])->name('diplomas.categorey.update');


        Route::get('/admin/diplomas', [diplomaController::class, 'index'])->name('diplomas.index');
        Route::get('/admin/diplomas/create', [diplomaController::class, 'create'])->name('diplomas.create');
        Route::post('/admin/diplomas/store', [diplomaController::class, 'store'])->name('diplomas.store');
        Route::get('/admin/diplomas/edit/{diploma}', [diplomaController::class, 'edit'])->name('diplomas.edit');
        Route::post('/admin/diplomas/update/{diploma}', [diplomaController::class, 'update'])->name('diplomas.update');
        Route::delete('/admin/diplomas/delete/{diploma}', [diplomaController::class, 'delete'])->name('diplomas.delete');

        Route::get('/admin/diplomas/requests/{diploma}', [diplomaRequestsController::class, 'requests'])->name('diplomas.requests');
        Route::post('/admin/diplomas/requests/{diploma}', [diplomaRequestsController::class, 'send'])->name('diplomas.send');


        Route::get('/admin/diplomas/lesson/{diploma}', [diplomaLessonController::class, 'index'])->name('diplomas.lesson');
        Route::get('/admin/diplomas/create/lesson/{diploma}', [diplomaLessonController::class, 'create'])->name('diplomas.create.lesson');
        Route::post('/admin/diplomas/create/lesson/{diploma}', [diplomaLessonController::class, 'store'])->name('diplomas.store.lesson');
        Route::delete('/admin/diplomas/delete/lesson/{diploma}', [diplomaLessonController::class, 'delete'])->name('diplomas.delete.lesson');

        Route::get('/admin/diplomas/schedules/{diploma}', [diplomaScheduleController::class, 'index'])->name('diplomas.schedule');
        Route::post('/admin/diplomas/schedules/{diploma}/store', [diplomaScheduleController::class, 'store'])->name('diplomas.schedule.store');
        Route::post('/admin/diplomas/schedules/{diploma}/update', [diplomaScheduleController::class, 'update'])->name('diplomas.schedule.update');
        Route::delete('/admin/diplomas/schedules/{diploma}/delete', [diplomaScheduleController::class, 'delete'])->name('diplomas.schedule.delete');


        Route::get('/admin/zoom/{diploma}/index/diploma', [diplomaMeetingController::class, 'index'])->name('admin.zoom.diploma.index')->middleware(CheckAdmin::class);
        Route::get('/admin/zoom/{diploma}/create/diploma', [diplomaMeetingController::class, 'create'])->name('admin.zoom.diploma.create')->middleware(CheckAdmin::class);
        Route::post('/admin/zoom/{diploma}/store/diploma', [diplomaMeetingController::class, 'storeZoom'])
            ->name('admin.zoom.diploma.store')
            ->middleware(CheckAdmin::class);
        Route::get('/admin/zoom/signature/{id}/diploma', [diplomaMeetingController::class, 'getSignature'])->name('admin.zoom.diploma.signature')->middleware(CheckAdmin::class);
        Route::get('/admin/zoom/signature-student/{id}/diploma', [diplomaMeetingController::class, 'getSignatureStudent'])
            ->name('admin.zoom.diploma.signature.student');
        Route::get('/admin/zoom/join/{id}/teacher/diploma', [diplomaMeetingController::class, 'joinPage'])->name('admin.zoom.diploma.join')->middleware(CheckAdmin::class);
        Route::get('/admin/zoom/{meeting}/delete/diploma', [diplomaMeetingController::class, 'deleteZoom'])->name('admin.zoom.diploma.delete')->middleware(CheckAdmin::class);

        Route::get('admin/payments', [adminpaymentController::class, 'index'])->name('admin.payments.index')->middleware(CheckAdmin::class);
        Route::get('admin/payments/cash/all', [adminpaymentController::class, 'students'])->name('admin.payments.cash')->middleware(CheckAdmin::class);
        Route::post('admin/payments', [adminpaymentController::class, 'edit'])->name('admin.payments.edit')->middleware(CheckAdmin::class);
        Route::post('admin/payments/{enrollments}', [adminpaymentController::class, 'success'])->name('admin.payments.success')->middleware(CheckAdmin::class);
    });
});

Route::group([
    'middleware' => ['auth', Teacher::class],
], function () {
    Route::controller(teacherController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/dashboard/courses/create', 'createCourse')->name('teacher.courses.create');
        Route::post('/dashboard/courses/create', 'storeCourse')->name('teacher.courses.store');
        Route::get('/dashboard/courses/edit/{slug}', 'editCourse')->name('teacher.courses.edit');
        Route::post('/dashboard/courses/edit/{slug}', 'updateCourse')->name('teacher.courses.update');
        Route::delete('/dashboard/courses/delete/{id}', 'deleteCourse')->name('teacher.courses.delete');
        Route::get('/dashboard/courses/{slug}', 'showCourse')->name('teacher.courses.show');
        Route::post('/dashboard/notification/{course}', 'sendNotification')->name('teacher.courses.notify');
        Route::get('/dashboard/courses/lessons/create/{slug}', 'createLesson')->name('teacher.lessons.create');
        Route::post('/dashboard/courses/lessons/create/{slug}', 'storeLesson')->name('teacher.lessons.store');
        Route::get('/dashboard/courses/lessons/edit/{slug}', 'editLesson')->name('teacher.lessons.edit');
        Route::post('/dashboard/courses/lessons/edit/{slug}', 'updateLesson')->name('teacher.lessons.update');
        Route::delete('/dashboard/courses/lessons/delete/{id}', 'deleteLesson')->name('teacher.lessons.delete');
        Route::get('/dashboard/courses/lessons/{slug}', 'showLesson')->name('teacher.lessons.show');
        Route::get('/dashboard/courses/lessons/quiz/create/{slug}', 'createQuiz')->name('teacher.quiz.create');
        Route::post('/dashboard/courses/quiz/create/{slug}', 'storeQuiz')->name('teacher.quiz.store');
        Route::post('/dashboard/courses/quiz/{id}', 'deleteQuiz')->name('teacher.quiz.delete');
        Route::get('/dashboard/courses/project/all/{slug}', 'allProjects')->name('teacher.project.all');
        Route::get('/dashboard/courses/project/create/{slug}/uploaded', 'createProject')->name('teacher.project.create');
        Route::get('/dashboard/courses/project/show/{project}', 'showUploadedProject')->name('teacher.projects.show');
        Route::post('/dashboard/courses/project/show/{project}/evaluate', 'evaluate')->name('teacher.assignments.evaluate');
        Route::delete('/dashboard/courses/project/show/{project}/delete', 'destroyProject')->name('teacher.projects.destroy');
        Route::post('/dashboard/courses/project/create/{slug}', 'storeProject')->name('teacher.project.store');
        Route::get('/dashboard/courses/project/edit/{slug}', 'editProject')->name('teacher.project.edit');
        Route::post('/dashboard/courses/project/edit/{id}', 'updateProject')->name('teacher.project.update');
        Route::get('/dashboard/courses/project/show/{slug}', 'showProject')->name('teacher.project.show');
        Route::delete('/dashboard/courses/project/{id}', 'deleteProject')->name('teacher.project.delete');
        Route::get('/dashboard/courses/{slug}/certificates', 'certificates')->name('teacherDashboard.certificates.index');
        Route::get('/dashboard/courses/{slug}/certificates/{id}/create', 'createCertificate')->name('teacherDashboard.certificates.create');
        Route::post('/dashboard/courses/{slug}/certificates/{id}/create', 'storeCertificate')->name('teacherDashboard.certificates.store');
        Route::get('/dashboard/courses/{slug}/certificates/assign/{user_id}', 'assignCertificate')->name('teacherDashboard.certificates.assign');
        Route::post('/dashboard/courses/{slug}/certificates/assign/{user_id}', 'storeCertificateUser')->name('teacherDashboard.certificatesUser.store');
        Route::get('/dashboard/courses/{slug}/certificates/download/{user_id}', 'downloadCertificate')->name('teacherDashboard.certificates.download');
        Route::get('/course-schedules/{course}/teacher', [CourseScheduleController::class, 'index'])->name('course-schedules.index');
        Route::get('/course-schedules/{course}/{day}/{time}/students/acess/go/teacher', [CourseScheduleController::class, 'students'])->name('course-schedules.students');
        Route::get('/course-schedules/create/{course}/{day}/teacher', [CourseScheduleController::class, 'create'])->name('course-schedules.create');
        Route::post('/course-schedules/create/{course}/teacher', [CourseScheduleController::class, 'store'])->name('course-schedules.store');
        Route::delete('/course-schedules/{courseSchedule}/delete/teacher', [CourseScheduleController::class, 'destroy'])->name('course-schedules.destroy');
        Route::delete(
            '/course-schedules/access/{access}',
            [CourseScheduleController::class, 'revoke']
        )->name('admin.course-schedules.students.revoke');
    });
});

Route::get('/google/auth', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');


Route::group([], function () {
    Route::get('/notFound/{slug}', [homeController::class, 'fromSearch'])->name('course.search')->middleware('auth');
});


Route::post('/pay/{course}/form/login/{type}', [ClickPayController::class, 'login'])->name('pay.form.login');
Route::post('/pay/{course}/form/redirect', [ClickPayController::class, 'redirect'])->name('pay.form.redirect');

Route::get('/pay/{course}/form', [ClickPayController::class, 'showPaymentForm'])->name('pay.form')->middleware('auth');
Route::get('/pay/{course}/form/auth', [ClickPayController::class, 'showPaymentFormauth'])->name('pay.form.auth')->middleware('auth');
Route::post('/pay/{course}/init', [ClickPayController::class, 'initiatePayment'])->name('pay.initiate')->middleware('auth');
Route::get('/pay/callback/{course}', [ClickPayController::class, 'callback'])->name('pay.callback');
Route::match(
    ['get', 'post'],
    '/pay/success/done/{course}/{user_id}',
    [ClickPayController::class, 'success']
)->name('pay.success')->withoutMiddleware(VerifyCsrfToken::class);
Route::post('/pay/fail/done', function () {
    return view('payment.failed');
})->name('pay.fail');

Route::get('/dashboard/zoom/{course}/index', [ZoomController::class, 'index'])->name('zoom.index')->middleware(Teacher::class);
Route::get('/dashboard/zoom/{course}/create', [ZoomController::class, 'create'])->name('zoom.create')->middleware(Teacher::class);
Route::post('/dashboard/zoom/{course}/store', [ZoomController::class, 'storeZoom'])
    ->name('zoom.store')
    ->middleware(Teacher::class);
Route::get('/dashboard/zoom/signature/{id}', [ZoomController::class, 'getSignature'])->name('zoom.signature')->middleware(Teacher::class);
Route::get('/dashboard/zoom/signature-student/{id}', [ZoomController::class, 'getSignatureStudent'])
    ->name('zoom.signature.student');
Route::get('/dashboard/zoom/join/{id}/teacher', [ZoomController::class, 'joinPage'])->name('zoom.join')->middleware(Teacher::class);
Route::get('/dashboard/zoom/join/{id}/student', [ZoomController::class, 'joinPageAsStudent'])->name('zoom.join.student');
Route::get('/dashboard/zoom/{meeting}/delete', [ZoomController::class, 'deleteZoom'])->name('zoom.delete')->middleware(Teacher::class);


Route::get('/admin/zoom/{course}/index', [AdminZoomController::class, 'index'])->name('admin.zoom.index')->middleware(CheckAdmin::class);
Route::get('/admin/zoom/{course}/create', [AdminZoomController::class, 'create'])->name('admin.zoom.create')->middleware(CheckAdmin::class);
Route::post('/admin/zoom/{course}/store', [AdminZoomController::class, 'storeZoom'])
    ->name('admin.zoom.store')
    ->middleware(CheckAdmin::class);
Route::get('/admin/zoom/signature/{id}', [AdminZoomController::class, 'getSignature'])->name('admin.zoom.signature')->middleware(CheckAdmin::class);
Route::get('/admin/zoom/signature-student/{id}', [AdminZoomController::class, 'getSignatureStudent'])
    ->name('admin.zoom.signature.student');
Route::get('/admin/zoom/join/{id}/teacher', [AdminZoomController::class, 'joinPage'])->name('admin.zoom.join')->middleware(CheckAdmin::class);
Route::get('/admin/zoom/{meeting}/delete', [AdminZoomController::class, 'deleteZoom'])->name('admin.zoom.delete')->middleware(CheckAdmin::class);


Route::get('/test-openai', function () {
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Hello from Laravel'],
                ],
            ]);

    return $response->json();
});


Route::group([], function () {
    Route::get('/gate', [GateController::class, 'index'])->name('gate.index');
    Route::get('/gate/diplomas', [GateController::class, 'Diplomas'])->name('gate.diplomas');
    Route::get('/gate/categories', [GateController::class, 'Categories'])->name('gate.categories');
    Route::get('/gate/diploma/{slug}', [GateController::class, 'showDiplomas'])->name('gate.diplomas.show.diploma');
    Route::get('/gate/diploma/{slug}/show', [GateController::class, 'show'])->name('gate.diplomas.show');
    Route::get('/gate/category/{slug}/show', [GateController::class, 'showcategorey'])->name('gate.diplomas.categorey.show');
    Route::get('/gate/me/diplomas/', [GateController::class, 'me'])->name('gate.diplomas.me');
    Route::get('/gate/diplomas/lesson/{lesson}/show', [GateController::class, 'showlesson'])->name('gate.diplomas.lesson.show');
    Route::post('/gate/diplomas/{diploma}/request', [GateController::class, 'request'])->name('gate.diplomas.request');
});



Route::get('/pay/{course}/form/diploma', [\App\Http\Controllers\diploma\clickpaycontroller::class, 'showPaymentForm'])->name('pay.form.diploma')->middleware('auth');
Route::post('/pay/{course}/init/diploma', [\App\Http\Controllers\diploma\clickpaycontroller::class, 'initiatePayment'])->name('pay.initiate.diploma')->middleware('auth');
Route::get('/pay/callback/{course}/diploma', [\App\Http\Controllers\diploma\clickpaycontroller::class, 'callback'])->name('pay.callback.diploma');
Route::match(
    ['get', 'post'],
    '/pay/success/done/{course}/{user_id}/diploma',
    [\App\Http\Controllers\diploma\clickpaycontroller::class, 'success']
)->name('pay.success.diploma')->withoutMiddleware(VerifyCsrfToken::class);
Route::post('/pay/fail/done/diploma', function () {
    return view('payment.failed');
})->name('pay.fail.diploma');
