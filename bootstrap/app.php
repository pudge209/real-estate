<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Middleware\Vendor;
use App\Http\Middleware\Client;
use App\Http\Middleware\LangManage;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'admin' => Admin::class,
                'client' => Client::class,
                'user' => User::class,
                'vendor' => Vendor::class,
            ]
            );
            $middleware->web(append: [
                LangManage::class,
            ]);
    })




    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
