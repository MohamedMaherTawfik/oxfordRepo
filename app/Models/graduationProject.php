<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class graduationProject extends Model
{
    protected $guarded = [];
    protected $table = 'graduation_projects';

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function assignmentUpload()
    {
        return $this->hasMany(assignment_submission::class);
    }
}
