<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationVideoSetting;
use Illuminate\Http\Request;

class RegistrationVideoController extends Controller
{
    /**
     * Display the registration video settings
     */
    public function index()
    {
        $setting = RegistrationVideoSetting::first();
        
        // Create default setting if doesn't exist
        if (!$setting) {
            $setting = RegistrationVideoSetting::create([
                'youtube_url' => '',
                'is_enabled' => true,
            ]);
        }

        return view('admin.registration-video.index', compact('setting'));
    }

    /**
     * Update the registration video settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'youtube_url' => 'nullable|url',
            'is_enabled' => 'boolean',
        ], [
            'youtube_url.url' => 'يجب أن يكون رابط يوتيوب صحيح',
        ]);

        $setting = RegistrationVideoSetting::first();
        
        if (!$setting) {
            RegistrationVideoSetting::create($validated);
        } else {
            $setting->update($validated);
        }

        return redirect()->route('admin.registration-video.index')
            ->with('success', 'تم تحديث إعدادات الفيديو بنجاح');
    }
}
