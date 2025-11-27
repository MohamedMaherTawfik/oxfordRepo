<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assignedCertificates extends Model
{
    protected $guarded = [];
    protected $table = 'assigned_certificates';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'certificate_id');
    }
}