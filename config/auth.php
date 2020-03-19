<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
            'hash' => false,
        ]
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ]
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

    'conductors' => [
        App\Services\Kavenegar::class
    ],

    'theories' => [
        'auth' => [
            'model' => App\EnterTheory\Auth::class
        ],
        'password' => [
            'model' => App\EnterTheory\Password::class
        ],
        'register' => [
            'model' => App\EnterTheory\Register::class
        ],
        'mobileCode' => [
            'model' => App\EnterTheory\MobileCode::class
        ],
        'recovery' => [
            'model' => App\EnterTheory\Recovery::class
        ]
    ],
    'registration' => false
];
