<?php

use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\StudentOnly;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminOnly::class,
            'student' => StudentOnly::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request): string {
            return $request->is('guru/*')
                ? route('guru.login')
                : ($request->is('admin/*') ? route('admin.login') : route('siswa.login'));
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
