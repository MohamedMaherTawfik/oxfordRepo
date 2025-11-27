<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ZoomHelper
{
    public static function getAccessToken()
    {
        $client_id = env('ZOOM_CLIENT_ID');
        $client_secret = env('ZOOM_CLIENT_SECRET');
        $redirect_uri = env('ZOOM_REDIRECT_URI');

        $response = Http::asForm()->post('https://zoom.us/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception("Failed to get access token: " . $response->body());
    }
}
