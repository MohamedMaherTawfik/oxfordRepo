<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany(Courses::class, 'categorey_id', 'id');
    }

}