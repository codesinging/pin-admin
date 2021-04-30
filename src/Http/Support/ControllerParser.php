<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Support;

use Illuminate\Support\Str;

trait ControllerParser
{
    /**
     * Get the current controller name.
     *
     * @param bool $snake
     *
     * @return string
     */
    protected function controllerName(bool $snake = true): string
    {
        $controller = Str::before(class_basename(request()->route()->getActionName()), 'Controller@');
        return $snake ? Str::snake($controller) : $controller;
    }

    /**
     * Get the current action name.
     *
     * @param bool $snake
     *
     * @return string
     */
    protected function actionName(bool $snake = true): string
    {
        $action = Str::after(class_basename(request()->route()->getActionName()), 'Controller@');
        return $snake ? Str::snake($action) : $action;
    }
}