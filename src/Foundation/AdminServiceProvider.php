<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The console commands of PinAdmin.
     *
     * @var array
     */
    protected $commands = [
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
}