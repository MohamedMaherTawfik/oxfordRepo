<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assignment_submission extends Model
{
    protected $guarded = [];
    protected $table = 'assignment_submissions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->belongsTo(assignments::class);
    }

    public function graduationProject()
    {
        return $this->belongsTo(graduationProject::class);
    }
}
