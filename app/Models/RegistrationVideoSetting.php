<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationVideoSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * Get the YouTube video ID from URL
     */
    public function getYoutubeIdAttribute()
    {
        if (!$this->youtube_url) {
            return null;
        }

        // Extract video ID from various YouTube URL formats
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->youtube_url, $matches);
        
        return $matches[1] ?? null;
    }

    /**
     * Get embed URL
     */
    public function getEmbedUrlAttribute()
    {
        if (!$this->youtube_id) {
            return null;
        }

        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }
}
