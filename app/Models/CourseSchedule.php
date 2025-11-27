<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    protected $table = 'course_schedules';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'courses_id');
    }

    public function diploma()
    {
        return $this->belongsTo(Diplomas::class, 'diplomas_id');
    }

    public function times()
    {
        return $this->hasMany(times::class);
    }
}
