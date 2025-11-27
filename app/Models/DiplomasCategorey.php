<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomasCategorey extends Model
{
    protected $table = 'diplomas_categoreys';

    protected $guarded = [];

    public function diplomas()
    {
        return $this->hasMany(Diplomas::class, 'diplomas_categorey_id');
    }
}
