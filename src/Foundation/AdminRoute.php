<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Closure;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AdminRoute
{
    /**
     * Set routes of the PinAdmin application.
     *
     * @param Closure $closure
     * @param bool $auth
     */
    public static function routeGroup(Closure $closure, bool $auth = true): void
    {
        $middleware = ['web'] + AdminFacade::config('middleware', []);
        if ($auth) {
            $middleware = array_merge($middleware, ['admin.auth:' . AdminFacade::guard()]);
        }

        Route::prefix(AdminFacade::routePrefix())
            ->name(AdminFacade::name() . '.')
            ->middleware($middleware)
            ->group(function () use ($closure) {
                call_user_func($closure);
            });
    }

    /**
     * Set resource routes.
     *
     * @param string $name
     * @param string $controller
     * @param array $routes
     *
     * @return void
     */
    public static function resourceRoutes(string $name, string $controller, array $routes = ['index', 'lists', 'store', 'update', 'destroy']): void
    {
        $singularName = Str::singular($name);
        in_array('index', $routes) and Route::get($name, [$controller, 'index'])->name($name . '.index');
        in_array('lists', $routes) and Route::get($name . '/lists', [$controller, 'lists'])->name($name . '.lists');
        in_array('store', $routes) and Route::post($name, [$controller, 'store'])->name($name . '.store');
        in_array('update', $routes) and Route::put("{$name}/{{$singularName}}", [$controller, 'update'])->name($name . '.update');
        in_array('destroy', $routes) and Route::delete("{$name}/{{$singularName}}", [$controller, 'destroy'])->name($name . '.destroy');
    }

    /**
     * The default routes of the PinAdmin application.
     */
    public static function defaultRoutes()
    {
        self::routeGroup(function () {
            Route::get('/', [Controllers\IndexController::class, 'index'])->name('index.index');
            Route::get('/home', [Controllers\IndexController::class, 'home'])->name('index.home');

            Route::get('/auth/edit', [Controllers\AuthController::class, 'edit'])->name('auth.edit');
            Route::put('/auth/update', [Controllers\AuthController::class, 'update'])->name('auth.update');

            self::resourceRoutes('admin_menus', Controllers\AdminMenusController::class);
            self::resourceRoutes('admin_users', Controllers\AdminUsersController::class);

        });

        self::routeGroup(function () {

            Route::get('/auth', [Controllers\AuthController::class, 'index'])->name('auth.index');
            Route::post('/auth/login', [Controllers\AuthController::class, 'login'])->name('auth.login');
            Route::get('/auth/logout', [Controllers\AuthController::class, 'logout'])->name('auth.logout');

        }, false);
    }
}