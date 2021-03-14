<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Admin
 *
 * @method static string version()
 * @method static string brand()
 * @method static string slogan()
 * @method static string name()
 * @method static string guard()
 * @method static string packagePath(string $path = '')
 * @method static string directory(string $path = '')
 * @method static string path(string $path = '')
 * @method static string getNamespace(string $path = '')
 *
 * @package CodeSinging\PinAdmin\Facades
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CodeSinging\PinAdmin\Foundation\Admin::class;
    }
}