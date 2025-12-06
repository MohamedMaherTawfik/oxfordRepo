<?php

namespace App\Providers;

use App\Interfaces\AnsewerInterface;
use App\Interfaces\AssignmentInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\CertificateInterface;
use App\Interfaces\CommentInterface;
use App\Interfaces\EnrollmentInterface;
use App\Interfaces\GraduationProjectInterface;
use App\Interfaces\LessonInterface;
use App\Interfaces\QuizesInterface;
use App\Interfaces\ReviewsInterface;
use App\Interfaces\SubmissionsInterface;
use App\Repository\AnswerRepository;
use App\Repository\AssignmentRepository;
use App\Repository\CategoreyRepository;
use App\Repository\CertificateRepository;
use App\Repository\CommentRepository;
use App\Repository\EnrollmentRepository;
use App\Repository\GraduationProjectRepository;
use App\Repository\LessonRepository;
use App\Repository\QuizRepository;
use App\Repository\ReviewRepository;
use App\Repository\SubmissionsRepository;
use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\Http\Middleware\Authenticate as JWTMiddleware;
use App\Interfaces\CourseInterface;
use App\Repository\CourseRepository;
use App\Interfaces\QuestionInterface;
use App\Repository\QuestionRepository;
use App\Models\Enrollments;
use App\Observers\EnrollmentObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CourseInterface::class, CourseRepository::class);
        $this->app->bind(LessonInterface::class, lessonRepository::class);
        $this->app->bind(QuizesInterface::class, QuizRepository::class);
        $this->app->bind(QuestionInterface::class, QuestionRepository::class);
        $this->app->bind(AnsewerInterface::class, AnswerRepository::class);
        $this->app->bind(commentInterface::class, CommentRepository::class);
        $this->app->bind(CertificateInterface::class, CertificateRepository::class);
        $this->app->bind(AssignmentInterface::class, AssignmentRepository::class);
        $this->app->bind(EnrollmentInterface::class, EnrollmentRepository::class);
        $this->app->bind(GraduationProjectInterface::class, GraduationProjectRepository::class);
        $this->app->bind(CategoryInterface::class, CategoreyRepository::class);
        $this->app->bind(ReviewsInterface::class, ReviewRepository::class);
        $this->app->bind(SubmissionsInterface::class, SubmissionsRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app('router')->aliasMiddleware('auth.jwt', JWTMiddleware::class);
        Enrollments::observe(EnrollmentObserver::class);
    }
}