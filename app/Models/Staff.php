<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    protected $table = 'staff_permissions';
    
    protected $fillable = [
        'user_id',
        'manage_users',
        'manage_teachers',
        'manage_courses',
        'manage_categories',
        'manage_diplomas',
        'manage_payments',
        'manage_certificates',
        'manage_applies',
        'manage_homepage',
        'manage_footer',
        'manage_staff',
    ];

    protected $casts = [
        'manage_users' => 'boolean',
        'manage_teachers' => 'boolean',
        'manage_courses' => 'boolean',
        'manage_categories' => 'boolean',
        'manage_diplomas' => 'boolean',
        'manage_payments' => 'boolean',
        'manage_certificates' => 'boolean',
        'manage_applies' => 'boolean',
        'manage_homepage' => 'boolean',
        'manage_footer' => 'boolean',
        'manage_staff' => 'boolean',
    ];

    /**
     * Get the user that owns the staff permissions.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
