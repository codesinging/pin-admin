<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\Commands\AdminCommand;
use CodeSinging\PinAdmin\Console\Commands\ListCommand;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The console commands of PinAdmin.
     *
     * @var array
     */
    protected $commands = [
        AdminCommand::class,
        ListCommand::class,
    ];

    /**
     * The middlewares of PinAdmin.
     *
     * @var array
     */
    protected $middlewares = [
    ];

    /**
     * Register PinAdmin services.
     */
    public function register()
    {
        $this->registerBinding();
        $this->registerCommands();
        $this->registerBinding();
    }

    /**
     * Bootstrap PinAdmin services.
     */
    public function boot()
    {
    }

    /**
     * Register the PinAdmin's binding to the container.
     */
    private function registerBinding(): void
    {
        $this->app->singleton(Admin::NAME, Admin::class);
    }

    /**
     * Register PinAdmin's console commands.
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register middleware for the application routes.
     */
    protected function registerMiddleware(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];

        foreach ($this->middlewares as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
    }
}