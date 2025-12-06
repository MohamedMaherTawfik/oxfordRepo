<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherSupportController extends Controller
{
    /**
     * Display all teacher support messages
     */
    public function index()
    {
        $messages = TeacherSupportMessage::with(['teacher', 'repliedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Count statistics
        $pendingCount = TeacherSupportMessage::where('status', 'pending')->count();
        $readCount = TeacherSupportMessage::where('status', 'read')->count();
        $repliedCount = TeacherSupportMessage::where('status', 'replied')->count();
        $totalCount = TeacherSupportMessage::count();

        return view('admin.teacher-support.index', compact('messages', 'pendingCount', 'readCount', 'repliedCount', 'totalCount'));
    }

    /**
     * Show a specific message
     */
    public function show(TeacherSupportMessage $message)
    {
        $message->load(['teacher', 'repliedBy']);
        
        // Mark as read if pending
        if ($message->status === 'pending') {
            $message->update(['status' => 'read']);
        }

        return view('admin.teacher-support.show', compact('message'));
    }

    /**
     * Reply to a message
     */
    public function reply(Request $request, TeacherSupportMessage $message)
    {
        $validated = $request->validate([
            'admin_reply' => 'required|string|min:10',
        ], [
            'admin_reply.required' => 'الرد مطلوب',
            'admin_reply.min' => 'الرد يجب أن يكون على الأقل 10 أحرف',
        ]);

        $message->update([
            'admin_reply' => $validated['admin_reply'],
            'status' => 'replied',
            'replied_by' => Auth::id(),
            'replied_at' => now(),
        ]);

        return redirect()->route('admin.teacher-support.show', $message)
            ->with('success', 'تم إرسال الرد بنجاح');
    }

    /**
     * Mark message as read
     */
    public function markAsRead(TeacherSupportMessage $message)
    {
        if ($message->status === 'pending') {
            $message->update(['status' => 'read']);
        }

        return redirect()->back()->with('success', 'تم تحديث الحالة');
    }
}
