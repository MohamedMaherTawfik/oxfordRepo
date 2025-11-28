<?php
use App\Http\Controllers\admin\lessonDiplomaController;
use App\Http\Controllers\api\admin\timesController;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\diploma\DiplomacategoreyController;
use App\Http\Controllers\api\diploma\DiplomasApiController;
use App\Http\Controllers\api\firebase\FirebaseController;
use App\Http\Controllers\api\schedulesController;
use App\Http\Controllers\api\student\categoreyController;
use App\Http\Controllers\api\student\commentController;
use App\Http\Controllers\api\student\CourseController;
use App\Http\Controllers\api\student\enrollmentController;
use App\Http\Controllers\api\student\lessonController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\home\notificationCotroller;
use App\Http\Controllers\home\zoomController;
use App\Http\Middleware\api\ownComment;
use App\Http\Middleware\authcheck;
use App\Http\Middleware\courseMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify-register', [AuthController::class, 'verifyOtpAfterRegister']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
    Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->middleware('jwt.auth');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('jwt.auth');
    Route::post('/forgot-password', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/new-password', [AuthController::class, 'foregetPass']);
    Route::post('/send-notify', [AuthController::class, 'sendNotify']);
    Route::get('/my-notifications', [notificationCotroller::class, 'myNotifications']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'categorey'
], function () {
    Route::controller(categoreyController::class)->group(
        function () {
            Route::get('/all', 'allCategories');
            Route::get('/detail/{id}', 'singleCategorey');
            Route::post('/create', 'createCategory');
            Route::post('/update/{id}', 'updateCategory');
            Route::delete('/delete/{id}', 'deleteCategory');
            Route::get('/detail/{id}/courses', 'coursesPerCategorey');
        }
    );
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'course',
], function () {
    Route::controller(CourseController::class)->group(
        function () {
            Route::get('/all', 'allCourses');
            Route::get('/detail/{id}', 'courseDetail')->middleware(authcheck::class);
            Route::post('/create', 'createCourse');
            Route::get('/search', 'searchCourses');
            Route::post('/update/{id}', 'updateCourse')->middleware(courseMiddleware::class);
            Route::delete('/delete/{id}', 'deleteCourse')->middleware(courseMiddleware::class);
            Route::get('/mycourses', 'mycourses')->middleware('jwt.auth');
            Route::get('/enrolled', 'EnrolledCourses')->middleware('jwt.auth');
            Route::post('/send-notification', 'sendNotification')->middleware('jwt.auth');
        }
    );
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'lesson',
], function () {
    Route::controller(lessonController::class)->group(
        function () {
            Route::get('/all/{id}', 'allLessons');
            Route::get('/detail/{id}', 'lessonDetails');
            Route::post('/{id}/create', 'createLesson');
            Route::post('/update/{id}', 'updateLesson');
            Route::delete('/delete/{id}', 'deleteLesson');
        }
    );
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'comment',
], function () {
    Route::controller(commentController::class)->group(
        function () {
            Route::post('/add/{lessonId}', 'addComment')->middleware('jwt.auth');
            Route::get('/all/{lessonId}', 'allComments');
            Route::post('/update/{id}', 'updateComment')->middleware('jwt.auth', ownComment::class);
            Route::delete('/delete/{id}', 'deleteComment')->middleware('jwt.auth', ownComment::class);
        }
    );
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'enrollment',
], function () {
    Route::controller(enrollmentController::class)->group(
        function () {
            Route::get('/all/{courseId}', 'allEnrollments');
            Route::post('/enroll/{courseId}', 'enrollCourse')->middleware('jwt.auth');
        }
    );
});

Route::post('/send-fcm', [FirebaseController::class, 'sendFCM'])->middleware('jwt.auth');

Route::get('/lastMeeting/{id}', [zoomController::class, 'getCourseLatestMeet'])->middleware('jwt.auth');
Route::group([
    'middleware' => 'api',
    'prefix' => 'diplomas',
], function () {
    Route::controller(DiplomasApiController::class)->group(
        function () {
            Route::get('/all', 'allCourses');
            Route::get('/detail/{id}', 'courseDetail')->middleware(authcheck::class);
            Route::post('/create', 'createCourse');
            Route::get('/search', 'searchCourses');
            Route::post('/update/{id}', 'updateCourse')->middleware(courseMiddleware::class);
            Route::delete('/delete/{id}', 'deleteCourse')->middleware(courseMiddleware::class);
            Route::get('/mycourses', 'mycourses')->middleware('jwt.auth');
            Route::get('/enrolled', 'EnrolledCourses')->middleware('jwt.auth');
            Route::post('/send-notification', 'sendNotification')->middleware('jwt.auth');
        }
    );
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'diplomacategorey'
], function () {
    Route::controller(DiplomacategoreyController::class)->group(
        function () {
            Route::get('/all', 'allCategories');
            Route::get('/detail/{id}', 'singleCategorey');
            Route::post('/create', 'createCategory');
            Route::post('/update/{id}', 'updateCategory');
            Route::delete('/delete/{id}', 'deleteCategory');
            Route::get('/detail/{id}/courses', 'coursesPerCategorey');
        }
    );
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'diplomalesson',
], function () {
    Route::controller(lessonDiplomaController::class)->group(
        function () {
            Route::get('/all/{id}', 'allLessons')->middleware('jwt.auth');
            Route::get('/detail/{id}', 'lessonDetails')->middleware('jwt.auth');
            Route::post('/{id}/create', 'createLesson')->middleware('jwt.auth');
            Route::post('/update/{id}', 'updateLesson')->middleware('jwt.auth');
            Route::delete('/delete/{id}', 'deleteLesson')->middleware('jwt.auth');
        }
    );
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'Schedules',
], function () {
    Route::controller(schedulesController::class)->group(
        function () {
            Route::get('/all/{id}', 'index')->middleware('jwt.auth');
            Route::get('/detail/{id}', 'show')->middleware('jwt.auth');
            Route::post('/{id}/create', 'create')->middleware('jwt.auth');
            Route::post('/update/{id}', 'update')->middleware('jwt.auth');
            Route::delete('/delete/{id}', 'destroy')->middleware('jwt.auth');
        }
    );
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'times',
], function () {
    Route::controller(timesController::class)->group(
        function () {
            Route::get('/all/{id}', 'index')->middleware('jwt.auth');
            Route::post('/{id}/create', 'create')->middleware('jwt.auth');
        }
    );
});