<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectByRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
/*         api: __DIR__ . '/../routes/api.php',   // ok même si tu n'as pas encore d'API
 */        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Mets ton middleware ici (PAS dans withRouting)
        $middleware->web(append: [
            RedirectByRole::class,
        ]);

        // (optionnel) alias pour l'utiliser dans les routes : 'role.redirect'
        $middleware->alias([
            'role.redirect' => RedirectByRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
