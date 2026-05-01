<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'org.verified'   => \App\Http\Middleware\EnsureOrganisationVerified::class,
            'platform.admin' => \App\Http\Middleware\PlatformAdmin::class,
        ]);

        $middleware->prependToGroup('web', \App\Http\Middleware\DetectCharitySite::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
