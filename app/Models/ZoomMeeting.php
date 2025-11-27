<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    protected $guarded = [];
    protected $casts = [
        'class_date_and_time' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function diploma()
    {
        return $this->belongsTo(Diplomas::class);
    }
}
