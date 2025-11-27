<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accessMeeting extends Model
{
    protected $table = 'access_meetings';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}