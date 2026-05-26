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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'active' => \App\Http\Middleware\EnsureUserIsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

    $exceptions->renderable(function (\Illuminate\Auth\Access\AuthorizationException $e, $request) {
        return redirect()->back()
            ->with('error', 'No tienes permiso para realizar esta acción.');
    });

    $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
        if ($e->getStatusCode() === 403) {
            return redirect()->back()
                ->with('error', 'No tienes permiso para realizar esta acción.');
        }
        if ($e->getStatusCode() === 404) {
            return redirect()->back()
                ->with('warning', 'Página no encontrada.');
        }
    });

})
    ->create();
