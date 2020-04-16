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
        'client_id' => '512862396299051',
        'client_secret' => '1d1f4321607a36ef42513b978006908d',
        'redirect' => env('APP_URL').'/callback/facebook',
    ],
    'google' => [
        'client_id' => '184714123444-sgso3mciacopm7dq42v8iorq5mhbt7d7.apps.googleusercontent.com',
        'client_secret' => 'gQ_t5pnDOj-4Kor5RBPqCKKd',
        'redirect' => env('APP_URL').'/callback/google',
    ],
];
