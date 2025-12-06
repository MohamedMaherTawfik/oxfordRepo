<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSupportMessage extends Model
{
    protected $guarded = [];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Get the teacher who sent the message
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the admin who replied
     */
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
