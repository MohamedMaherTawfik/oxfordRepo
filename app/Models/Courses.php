<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $guarded = [];
    protected $table = 'courses';

    public function enrolledUser()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'courses_id', 'user_id')
            ->withPivot(['price', 'transaction_type'])
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseSchedules()
    {
        return $this->hasMany(CourseSchedule::class, 'courses_id');
    }

    public function lessons()
    {
        return $this->hasMany(lesson::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollments::class, 'courses_id');
    }

    public function category()
    {
        return $this->belongsTo(categories::class, 'categorey_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(Reviews::class);
    }
    public function quiz()
    {
        return $this->hasMany(quizes::class);
    }

    public function courseMeetings()
    {
        return $this->hasMany(CourseMeeting::class);
    }

    public function zoomMeetings()
    {
        return $this->hasMany(ZoomMeeting::class);
    }

    public function courseNotes()
    {
        return $this->hasMany(CourseNotes::class);
    }
}