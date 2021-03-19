<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Facades;

use Closure;
use CodeSinging\PinAdmin\Foundation\Admin as AdminClass;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\HtmlString;

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
 * @method static AdminClass|array|mixed config($key = null, $default = null)
 * @method static string routePrefix()
 * @method static string route(string $name, array $parameters = [], bool $absolute = true)
 * @method static Application|UrlGenerator|string url(string $path = null, array $parameters = [], bool $secure = null)
 * @method static string link(string $path = '', array $parameters = [])
 * @method static string home()
 * @method static string asset(string $path = '')
 * @method static HtmlString|string mix(string $path)
 * @method static string template(string $path)
 * @method static Application|Factory|View view(string $view, $data = [], $mergeData = [])
 * @method static Guard|StatefulGuard auth()
 * @method static Authenticatable|null user()
 * @method static AdminClass routeGroup(Closure $closure, bool $auth = true)
 * @method static AdminClass resourceRoutes(string $name, string $controller, array $routes = ['index', 'lists', 'store', 'update', 'destroy'])
 *
 * @package CodeSinging\PinAdmin\Facades
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdminClass::class;
    }
}