<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;

if (!function_exists('admin')) {
    /**
     * Get the Admin instance.
     *
     * @return Application|Admin
     */
    function admin()
    {
        return app(Admin::class);
    }
}

if (!function_exists('admin_mix')) {
    /**
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     */
    function admin_mix(string $path)
    {
        return admin()->mix($path);
    }
}

if (!function_exists('admin_asset')) {
    /**
     * Get the assets url of PinAdmin.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_asset(string $path = ''): string
    {
        return admin()->asset($path);
    }
}

if (!function_exists('admin_config')) {
    /**
     * Get or set the specified configuration value of the PinAdmin application.
     *
     * @param null $key
     * @param null $default
     *
     * @return array|Admin|mixed
     */
    function admin_config($key = null, $default = null)
    {
        return admin()->config($key, $default);
    }
}

if (!function_exists('admin_template')){
    /**
     * Get the PinAdmin view template.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_template(string $path): string
    {
        return admin()->template($path);
    }
}

if (!function_exists('admin_view')){
    /**
     * Get the view for PinAdmin.
     *
     * @param string $view
     * @param array $data
     * @param array $mergeData
     *
     * @return Application|Factory|View
     */
    function admin_view(string $view, $data = [], $mergeData = [])
    {
        return view(admin()->template($view), $data, $mergeData);
    }
}

if (!function_exists('call_closure')) {
    /**
     * Call a user function given by the first parameter, and the second parameter serve as the user function's parameter.
     * If the closure function does not has a return or return null, then this function return the second parameter.
     *
     * @param Closure $closure
     * @param mixed $parameters
     *
     * @return mixed
     */
    function call_closure(Closure $closure, $parameters = null)
    {
        return call_user_func($closure, $parameters) ?? $parameters;
    }
}