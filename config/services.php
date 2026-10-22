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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Counselling and exam pages read the backend's public API (api/v1). site_key = the backend's CNS_SITE_KEY.
    'enrollzy_api' => [
        'url' => rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/api/v1',
        'site_key' => env('CNS_SITE_KEY'),
        'timeout' => (int) env('ENROLLZY_API_TIMEOUT', 8),
        'cache_seconds' => (int) env('ENROLLZY_API_CACHE', 60),
    ],

];
