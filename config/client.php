<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client POS application URL
    |--------------------------------------------------------------------------
    |
    | Used in emails and public links (e.g. after self-registration).
    |
    */

    'url' => rtrim((string) env('CLIENT_APP_URL', 'http://client.pos-system.test'), '/'),

    /*
    |--------------------------------------------------------------------------
    | Trial period (days) for new self-registered clients
    |--------------------------------------------------------------------------
    */

    'trial_days' => (int) env('CLIENT_TRIAL_DAYS', 3),

];
