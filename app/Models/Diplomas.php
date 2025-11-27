<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplomas extends Model
{
    protected $table = 'diplomas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorey()
    {
        return $this->belongsTo(DiplomasCategorey::class, 'diplomas_categorey_id');
    }

    public function lessons()
    {
        return $this->hasMany(lesson::class);
    }

    public function courseSchedule()
    {
        return $this->hasMany(CourseSchedule::class);
    }

    public function zoomMeetings()
    {
        return $this->hasMany(ZoomMeeting::class);
    }

    public function requests()
    {
        return $this->hasMany(RequestCertificate::class);
    }

    public function sendCertificate()
    {
        return $this->hasMany(sendCertificates::class);
    }
}
