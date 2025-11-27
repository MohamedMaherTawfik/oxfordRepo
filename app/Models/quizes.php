<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quizes extends Model
{
    protected $guarded = [];
    protected $table = 'quizes';
    public function questions()
    {
        return $this->hasMany(questions::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}