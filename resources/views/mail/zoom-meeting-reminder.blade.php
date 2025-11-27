{{-- resources/views/emails/zoom_meeting_reminder.blade.php --}}
<h2>Hello {{ $user->name }} 👋</h2>

<p>You have a new Zoom meeting for your course <strong>{{ $course->title }}</strong>.</p>

<p><strong>Meeting Time:</strong> {{ $meeting->start_time->format('l, d M Y h:i A') }}</p>

<p>
    <a href="{{ $meeting->join_url }}"
        style="padding: 10px 15px; background-color: #2563eb; color: white; border-radius: 5px; text-decoration: none;">
        🔗 Join Zoom Meeting
    </a>
</p>

<p>Best regards,<br>Oxford Platform</p>
