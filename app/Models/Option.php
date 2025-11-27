<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];
    protected $table = 'options';

    public function question()
    {
        return $this->belongsTo(questions::class);
    }
}
