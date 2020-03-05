<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'flowroute' => [
        'base64_encoded' => 'NTEzMTQ5OTI6ZDBiMWY3ZjZkYTExNzExNmY5MDhmY2U1MzkwZjUwZWY=',
        'access_key' => '51314992',
        'secret_key' => 'd0b1f7f6da117116f908fce5390f50e',
        'from_number' => env('SMS_FROM', '13073635500'),
        'send_to_override' => env('SMS_DEV', false),
      //  'forward_to' => env('SMS_DEV', '1XXXXXXXXXX'),
      // 'webhook_url' => env('APP_URL') . '/webhooks/sms/receive',
        'webhook_url' => env('APP_URL') . '/api/app_module/?module=phone_validation_module&action=callback',
    ],

];
/*
 *
 * Access Key:   51314992
Secret Key:   d0b1f7f6da117116f908fce5390f50ef
 curl https://api.flowroute.com/v2.1/messages \
-H "Content-Type: application/vnd.api+json" -X POST -d \
'{"to": "12487896067", "from": "13073635500", "body": "84612"}' \
-u 51314992:d0b1f7f6da117116f908fce5390f50ef

'{"to": "12487896067", "from": "13073635500", "body": "84612", "dlr_callback: "https://example.com/message_to_slack"}' \

 *
 */
