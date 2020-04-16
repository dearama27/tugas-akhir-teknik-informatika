<?php

return [
    "status"   => (bool) env('RECAPTCHA', false),
    "site_key" => env('RECAPTCHA_SITE_KEY', ''),
    "secret_key" => env('RECAPTCHA_SECRET_KEY', '')
];