<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Contracts\Foundation\Application;
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
