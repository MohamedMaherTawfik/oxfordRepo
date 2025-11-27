<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'openai' => [
        'key' => env('CHAT_KEY'),
    ],

    'clickpay' => [
        'profile_id' => env('CLICKPAY_PROFILE_ID'),
        'server_key' => env('CLICKPAY_SERVER_KEY'),
        'client_key' => env('CLICKPAY_CLIENT_KEY'),
        'currency' => env('CLICKPAY_CURRENCY', 'SAR'),
        'base_url' => env('CLICKPAY_BASE_URL', 'https://secure.clickpay.com.sa/'),
    ],

    'zoom' => [
        'zoom_client_id' => env('ZOOM_S2S_CLIENT_ID'),
        'zoom_client_secret' => env('ZOOM_S2S_CLIENT_SECRET'),
        'zoom_account_id' => env('ZOOM_S2S_ACCOUNT_ID'),
        'zoom_sdk_client_id' => env('ZOOM_SDK_ID'),
        'zoom_sdk_client_secret' => env('ZOOM_SDK_SECRET'),
    ],


];