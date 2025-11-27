<?php

namespace App\Http\Controllers\home;

use Google\Client as GoogleClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope([
            'https://www.googleapis.com/auth/youtube.upload',
            'https://www.googleapis.com/auth/youtube',
            'https://www.googleapis.com/auth/youtube.force-ssl',
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    public function handleGoogleCallback()
    {
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        if (request()->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode(request('code'));

            if (!isset($token['error'])) {
                Session::put('youtube_token', $token);
                return redirect()->route('dashboard')->with('success', 'تم تسجيل الدخول بحساب Google بنجاح ✅');
            }
        }

        return redirect()->route('dashboard')->with('error', 'فشل تسجيل الدخول بحساب Google ❌');
    }


}
