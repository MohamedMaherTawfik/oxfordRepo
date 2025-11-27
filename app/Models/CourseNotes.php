<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseNotes extends Model
{
    protected $table = 'course_notes';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}