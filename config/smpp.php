<?php

return [
    'ip'       => env('SMPP_IP'),
    'port'     => env('SMPP_PORT'),
    'from'     => env('SMPP_FROM', '0764'),
    'username' => env('SMPP_USERNAME'),
    'password' => env('SMPP_PASSWORD'),
    'timeout'  => env('SMPP_TIMEOUT', 10000),
];
