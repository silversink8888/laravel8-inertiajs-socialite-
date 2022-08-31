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

    'line' => [
        'client_id'     =>env('LINE_CHANNEL_ID'),
        'client_secret' =>env('LINE_CHANNEL_SECRET'),
        'redirect'      =>env('LINE_REDIRECT'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_CALLBACK_URL'),
    ],

    'twitter' => [
        'client_id'       => env('TWITTER_CLIENT_ID'),
        'client_secret'   => env('TWITTER_CLIENT_SECRET'),
        'redirect'        => env('TWITTER_CLIENT_CALLBACK'),
        'oauth'           => 2,
    ],

    'github' => [
        'client_id'       => env('GITHUB_CLIENT_ID'),
        'client_secret'   => env('GITHUB_CLIENT_SECRET'),
        'redirect'        => env('GITHUB_URL'),
    ],

    'yahoo' => [
        'client_id'     => env('YahooJp_ID'),
        'client_secret' => env('YahooJp_SECRET'),
        'redirect'      => env('YahooJp_CALLBACKURL'),
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect'      => env('FACEBOOK_CALLBACK_URL'),
    ],

    'slack' => [
        'client_id'     => env('SLACK_CLIENT_ID'),
        'client_secret' => env('SLACK_CLIENT_SECRET'),
        'redirect'      => env('SLACK_REDIRECT_CALLBACK_URL'),
    ],

    'instagram' => [
        'client_id'     => env('INSTAGRAM_KEY'),
        'client_secret' => env('INSTAGRAM_SECRET'),
        'redirect'      => env('INSTAGRAM_REDIRECT_URI'),
    ],

];
