<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    protected $guarded = [];
    protected $table = 'lessons';

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quizes()
    {
        return $this->hasMany(quizes::class);
    }

    public function comments()
    {
        return $this->hasMany(comments::class);
    }

    public function assignments()
    {
        return $this->hasMany(assignments::class);
    }

    public function diplomas()
    {
        return $this->belongsTo(Diplomas::class);
    }
}