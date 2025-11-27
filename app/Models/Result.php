<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];
    protected $table = 'results';

    public function quiz()
    {
        return $this->belongsTo(quizes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}