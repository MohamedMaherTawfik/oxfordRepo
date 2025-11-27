<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestCertificate extends Model
{
    protected $table = 'request_certificates';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diploma()
    {
        return $this->belongsTo(Diplomas::class);
    }
}