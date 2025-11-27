<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class times extends Model
{
    protected $table = 'times';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function CourseSchedule()
    {
        return $this->belongsTo(CourseSchedule::class);
    }
}