<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ZoomLiveService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('services.zoom') ?? [];
    }

    public function createZoomToken()
    {
        if (empty($this->config['zoom_client_id']) || empty($this->config['zoom_client_secret']) || empty($this->config['zoom_account_id'])) {
            throw new \Exception('Zoom S2S credentials not configured in config/services.php or .env');
        }

        $url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$this->config['zoom_account_id']}";

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->config['zoom_client_id'] . ':' . $this->config['zoom_client_secret']),
        ])->post($url);

        if ($response->failed()) {
            Log::error('Zoom Token Error', ['response' => $response->body()]);
            throw new \Exception("Failed to get Zoom token: " . $response->body());
        }

        return $response->json('access_token');
    }

    public function createZoomLive(array $data)
    {
        $token = $this->createZoomToken();

        $response = Http::withToken($token)->post("https://api.zoom.us/v2/users/me/meetings", [
            'topic' => $data['class_topic'],
            'type' => 2,
            'start_time' => $data['class_date_and_time'],
            'duration' => $data['duration'] ?? 60,
            'timezone' => config('app.timezone'),
            'settings' => [
                'join_before_host' => true,
                'approval_type' => 2,
            ],
        ]);

        if ($response->failed()) {
            Log::error('Zoom create meeting failed', ['body' => $response->body()]);
            throw new \Exception("Zoom create meeting failed: " . $response->body());
        }

        return $response->json();
    }

    public function generateSignature(string $meetingNumber, int $role = 0): string
    {
        if (empty($this->config['zoom_sdk_client_id']) || empty($this->config['zoom_sdk_client_secret'])) {
            throw new \Exception('Zoom SDK credentials not configured');
        }

        $sdkKey = $this->config['zoom_sdk_client_id'];
        $sdkSecret = $this->config['zoom_sdk_client_secret'];

        $iat = time();
        $exp = $iat + 7200;

        $payload = [
            'sdkKey' => $sdkKey,
            'mn' => $meetingNumber,
            'role' => $role,
            'iat' => $iat,
            'exp' => $exp,
            'tokenExp' => $exp,
        ];

        return JWT::encode($payload, $sdkSecret, 'HS256');
    }
}
