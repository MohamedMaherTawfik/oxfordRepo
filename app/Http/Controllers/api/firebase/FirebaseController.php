<?php

namespace App\Http\Controllers\api\firebase;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    public function sendFCM(Request $request, FirebaseService $firebase)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $user = auth()->user()->load('fcmTokens');

        foreach ($user->fcmTokens as $token) {
            if (empty($token->token)) {
                continue;
            }

            try {
                $firebase->sendNotification($token->token, $request->title, $request->body);
            } catch (\Throwable $e) {
                return response()->json([
                    'error' => 'Failed to send notification: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json(['status' => 'Notification Sent']);
    }

}
