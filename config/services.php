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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
        'facebook' => [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'redirect' => env('FACEBOOK_Redirect'),
        ],
        'google' => [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect' =>  env('GOOGLE_Redirect'),
        ],
        'linkedin' => [
            'client_id' => env('LINKEDIN_CLIENT_ID'),
            'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
            'redirect' =>  env('LINKEDIN_Redirect'),
        ],

    // 'facebook' => [
    //     'client_id' => '860884418660065',
    //     'client_secret' => 'c917fb5f29a75212d2d68e0f5e9cabac',
    //     'redirect' => env('APP_URL') . '/auth/facebook/callback',
    //     'default_graph_version' => 'v3.2',
    // ],
    // 'google' => [
    //     'client_id' => '959883475680-s91c0tuhubqfvt6u36o50s01smb981fa.apps.googleusercontent.com',
    //     'client_secret' => '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',
    //     'redirect' => env('APP_URL') . '/auth/google/callback',
    //     // 'scopes' => [
    //     //     \Google_Service_Gmail::GMAIL_READONLY
    //     // ],
    //     'access_type' => 'offline',
    //     'prompt' => 'consent',
    //     'use_oidc_mode' => true,

    // ],
    // 'linkedin' => [
    //     'client_id' => '77ib54h0sr82c4',
    //     'client_secret' => 'VWbBlUUIHMdYexv8',
    //     'redirect' => env('APP_URL') . 'social-media/login/linkedin/callback',
    // ],

];
