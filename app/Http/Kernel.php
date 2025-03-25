<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Middleware global yang dijalankan pada setiap request
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middleware untuk rute web
        ],
        'api' => [
            // Middleware untuk rute API
        ],
    ];

    protected $routeMiddleware = [
        // Middleware yang dapat diaplikasikan ke rute tertentu

        'hr.auth' => \App\Http\Middleware\RedirectIfNotHr::class,
        'redirect.guard' => \App\Http\Middleware\RedirectBasedOnGuard::class,
    
        // ... middleware lainnya
    ];


}