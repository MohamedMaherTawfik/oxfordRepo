<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\footer;
use App\Models\TeacherSupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /**
     * Display the support page with contact information and message form
     */
    public function index()
    {
        $footer = footer::first();
        
        // Create default footer object if doesn't exist
        if (!$footer) {
            $footer = (object) [
                'phone' => null,
                'email' => null,
                'address' => null,
                'whatsapp' => null,
                'telegram' => null,
                'facebook' => null,
                'instgram' => null,
            ];
        }
        
        $messages = TeacherSupportMessage::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('teacherDashboard.support.index', compact('footer', 'messages'));
    }

    /**
     * Store a new support message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'subject.required' => __('teacher.subject_required'),
            'message.required' => __('teacher.message_required'),
            'message.min' => __('teacher.message_min'),
        ]);

        TeacherSupportMessage::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return redirect()->route('teacher.support.index')
            ->with('success', __('teacher.message_sent_successfully'));
    }
}
