<?php

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'author' => [
            'driver' => 'session',
            'provider' => 'authors',
        ],
        'citizen' => [
            'driver' => 'session',
            'provider' => 'citizens',
        ],
        'service_employee' => [
            'driver' => 'session',
            'provider' => 'service_employees',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'authors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Author::class,
        ],
        'citizens' => [
            'driver' => 'eloquent',
            'model' => App\Models\Citizen::class,
        ],
        'service_employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\ServiceEmployee::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
