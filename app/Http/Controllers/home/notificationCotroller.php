<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notificationCotroller extends Controller
{
    public function index()
    {
        $notifications = notification::where('reciever_id', Auth::user()->id)->get();
        return view('home.notifications.index', compact('notifications'));
    }

    public function myNotifications()
    {
        $notifications = notification::where('reciever_id', Auth::guard('api')->id())->get();
        return response()->json(
            ['message' => 'My Notifications', 'data' => $notifications]
        );
    }
}