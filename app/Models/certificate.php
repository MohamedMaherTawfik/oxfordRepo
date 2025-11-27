<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    protected $table = 'certificates';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function assignedCertificates()
    {
        return $this->belongsToMany(assignedCertificates::class, 'assigned_certificates', 'certificate_id', 'user_id')
            ->withTimestamps();
    }
}
