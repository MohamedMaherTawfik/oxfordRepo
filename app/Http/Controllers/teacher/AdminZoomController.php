<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\ZoomMeeting;
use App\services\ZoomLiveService;
use Illuminate\Http\Request;

class AdminZoomController extends Controller
{
    public function index(Courses $course)
    {
        $meetings = ZoomMeeting::where('courses_id', $course->id)->get();
        return view('adminCourse.zoom.index', compact('meetings', 'course'));
    }
    public function create(Courses $course)
    {
        return view('adminCourse.zoom.create', compact('course'));
    }
    public function storeZoom(Request $request, Courses $course, ZoomLiveService $zoomService)
    {
        $data = $request->validate([
            'class_topic' => 'required|string|max:255',
            'class_date_and_time' => 'required|date',
        ]);

        try {
            $zoomResponse = $zoomService->createZoomLive($data);

            $meeting = ZoomMeeting::create([
                'courses_id' => $course->id,
                'class_topic' => $data['class_topic'],
                'class_date_and_time' => $data['class_date_and_time'],
                'meeting_id' => $zoomResponse['id'] ?? null,
                'meeting_password' => $zoomResponse['password'] ?? null,
                'start_url' => $zoomResponse['start_url'] ?? null,
                'join_url' => $zoomResponse['join_url'] ?? null,
                'status' => 'scheduled',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Zoom meeting created successfully',
                'meeting' => $meeting,
                'zoom_response' => $zoomResponse,
                'password' => $meeting->meeting_password
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
    public function getSignature($id, ZoomLiveService $zoomService)
    {
        $liveClass = ZoomMeeting::findOrFail($id);

        if (!$liveClass->meeting_id) {
            return response()->json(['error' => 'Meeting not created'], 404);
        }

        try {
            $signature = $zoomService->generateSignature($liveClass->meeting_id, 1);
            return response()->json([
                'meetingNumber' => (string) $liveClass->meeting_id,
                'signature' => $signature,
                'password' => $liveClass->meeting_password ?? '',
                'role' => 1,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getSignatureStudent($id, ZoomLiveService $zoomService)
    {
        $liveClass = ZoomMeeting::findOrFail($id);

        if (!$liveClass->meeting_id) {
            return response()->json(['error' => 'Meeting not created'], 404);
        }

        try {
            $signature = $zoomService->generateSignature($liveClass->meeting_id, 0); // role = 0 (student)
            return response()->json([
                'meetingNumber' => (string) $liveClass->meeting_id,
                'signature' => $signature,
                'password' => $liveClass->meeting_password ?? '',
                'role' => 0,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteZoom(ZoomMeeting $meeting)
    {
        $meeting->delete();
        return redirect()->back();
    }

    public function joinPage($id)
    {
        $meeting = ZoomMeeting::findOrFail($id);
        return view('adminCourse.zoom.join', compact('meeting'));
    }
}