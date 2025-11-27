<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class applyTeacher extends Model
{
    protected $table = 'apply_teachers';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}