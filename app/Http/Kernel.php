<?php 

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Middleware العالمي
        \App\Http\Middleware\SetLocale::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Middleware لمجموعة الويب
            \App\Http\Middleware\SetLocale::class,
        ],

        'api' => [
            // Middleware لمجموعة API
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Middleware الفردي
    ];
}
