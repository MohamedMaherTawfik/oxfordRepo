<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    protected $guarded = [];
    protected $table = 'answers';
    public function question()
    {
        return $this->belongsTo(questions::class);
    }

}
