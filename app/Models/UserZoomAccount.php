<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserZoomAccount extends Model
{
    protected $table = 'user_zoom_accounts';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
