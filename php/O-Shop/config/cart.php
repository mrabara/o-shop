<?php

return [
    'cookie' => [
        'name' => env('CART_COOKIE', 'cart_cookie'),
        'expiration' => 7 * 24 * 60,
    ],
];
