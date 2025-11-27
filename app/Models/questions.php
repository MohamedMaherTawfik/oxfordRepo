<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    protected $guarded = [];
    protected $table = 'questions';
    public function quiz()
    {
        return $this->belongsTo(quizes::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

}