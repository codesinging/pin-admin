<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Contracts\Foundation\Application;

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