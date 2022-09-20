<?php

return [
    'users' => [
        'superadmin' => [
            'name' => env('SUPERADMIN_NAME', 'Superadmin'),
            'email' => env('SUPERADMIN_EMAIL'),
            'password' => env('SUPERADMIN_PASSWORD'),
            'password_confirmation' => env('SUPERADMIN_PASSWORD'),
        ],
    ],
];
