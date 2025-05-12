<?php

return [
    'ip' => env('SMPP_IP'),
    'port' => env('SMPP_PORT', 2775),
    'from' => env('SMPP_FROM'),
    'username' => env('SMPP_USERNAME'),
    'password' => env('SMPP_PASSWORD'),
];
