<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fcmToken extends Model
{
    protected $guarded = [];
    protected $table = 'fcm_tokens';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}