<?php

namespace App\Http\Controllers\api\googleAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YouTubeController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setAccessType("offline");
        $client->setPrompt("consent");
        $client->addScope("https://www.googleapis.com/auth/youtube.upload");

        $authUrl = $client->createAuthUrl();

        return response()->json(['url' => $authUrl]);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        if ($request->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->code);

            if (isset($token['access_token'])) {
                $user = Auth::guard('api')->user();
                $user->youtube_token = json_encode($token);
                $user->save();

                return response()->json(['message' => 'تم ربط حساب Google بنجاح ✅']);
            }
        }

        return response()->json(['error' => 'فشل تسجيل الدخول'], 403);
    }

}