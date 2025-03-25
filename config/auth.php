<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'karyawan',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'karyawan',
        ],

        'hr' => [
            'driver' => 'session',
            'provider' => 'hr_admins',
        ],
    ],

    'providers' => [
        'karyawan' => [
            'driver' => 'eloquent',
            'model' => App\Models\Karyawan::class,
        ],

        'hr_admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\HrAdmin::class,
        ],
    ],

    'passwords' => [
        'karyawan' => [
            'provider' => 'karyawan',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'hr_admins' => [
            'provider' => 'hr_admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];