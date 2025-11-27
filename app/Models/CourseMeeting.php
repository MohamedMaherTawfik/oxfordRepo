<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMeeting extends Model
{
    protected $guarded = [];
    protected $table = 'course_meetings';

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}