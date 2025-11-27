<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assignments extends Model
{
    protected $guarded = [];
    protected $table = 'assignments';

    public function lesson()
    {
        return $this->belongsTo(lesson::class);
    }

    public function assignmentSubmissions()
    {
        return $this->hasMany(assignment_submission::class);
    }
}
