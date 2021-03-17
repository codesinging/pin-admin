<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Admin
{
    /**
     * PinAdmin version.
     */
    const VERSION = '0.0.1';

    /**
     * PinAdmin brand.
     */
    const BRAND = 'PinAdmin';

    /**
     * PinAdmin slogan.
     */
    const SLOGAN = 'Rapidly build administration application based on Laravel';

    /**
     * PinAdmin name.
     */
    const NAME = 'admin';

    /**
     * PinAdmin guard.
     */
    const GUARD = 'admin';

    /**
     * PinAdmin application directory.
     */
    const DIRECTORY = 'PinAdmin';

    /**
     * Retrieve the version.
     * @return string
     */
    public function version(): string
    {
        return self::VERSION;
    }

    /**
     * Retrieve the brand.
     * @return string
     */
    public function brand(): string
    {
        return self::BRAND;
    }

    /**
     * Retrieve the slogan.
     * @return string
     */
    public function slogan(): string
    {
        return self::SLOGAN;
    }

    /**
     * Retrieve the name of PinAdmin.
     * @return string
     */
    public function name(): string
    {
        return self::NAME;
    }

    /**
     * Retrieve the guard of PinAdmin.
     * @return string
     */
    public function guard(): string
    {
        return self::GUARD;
    }

    /**
     * Get the package path of PinAdmin.
     * @param string $path
     * @return string
     */
    public function packagePath(string $path = ''): string
    {
        return dirname(dirname(__DIR__)) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Retrieve the directory.
     * @param string $path
     * @return string
     */
    public function directory(string $path = ''): string
    {
        return self::DIRECTORY . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Get the application path.
     * @param string $path
     * @return string
     */
    public function path(string $path = ''): string
    {
        return app_path($this->directory($path));
    }

    /**
     * Get the application namespace.
     * @param string $path
     * @return string
     */
    public function getNamespace(string $path = ''): string
    {
        return app()->getNamespace() . str_replace('/', '\\', $this->directory($path));
    }

    /**
     * Get or set the specified configuration value of the PinAdmin application.
     * @param null|array|string $key
     * @param null|mixed $default
     * @return $this|array|mixed
     */
    public function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return config($this->name());
        }

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                config([$this->name() . '.' . $k => $v]);
            }
            return $this;
        }

        return config($this->name() . '.' . $key, $default);
    }

    /**
     * Get the route prefix of PinAdmin application.
     * @return string
     */
    public function routePrefix(): string
    {
        return $this->config('route_prefix');
    }

    /**
     * Generate the URL of PinAdmin application to a named route.
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    public function route(string $name, array $parameters = [], bool $absolute = true): string
    {
        return route($this->name() . '.' . $name, $parameters, $absolute);
    }

    /**
     * Generate a url for the PinAdmin application.
     * @param string|null $path
     * @param array $parameters
     * @param bool|null $secure
     * @return Application|UrlGenerator|string
     */
    public function url(string $path = null, array $parameters = [], bool $secure = null)
    {
        $path = $this->routePrefix() . (empty($path) ? '' : Str::start($path, '/'));

        return url($path, $parameters, $secure);
    }

    /**
     * Get a absolute url for the PinAdmin application.
     * @param string $path
     * @param array $parameters
     * @return string
     */
    public function link(string $path = '', array $parameters = []): string
    {
        $link = '/' . $this->routePrefix();
        if ($path) {
            $link .= Str::start($path, '/');
        }
        if ($parameters) {
            $link .= '?' . http_build_query($parameters);
        }
        return $link;
    }

    /**
     * The home's link of the PinAdmin application.
     * @return string
     */
    public function home(): string
    {
        return $this->link(rtrim($this->config('home'), '/'));
    }

    /**
     * Get the assets url of PinAdmin.
     * @param string $path
     * @return string
     */
    public function asset(string $path = ''): string
    {
        if (Str::startsWith($path, ['https://', 'http://', '//', '/'])) {
            return $path;
        }
        return '/static/vendor/' . $this->name() . '/' . Str::kebab($path);
    }

    /**
     * Get the path to a versioned Mix file of the PinAdmin application.
     *
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     */
    public function mix(string $path)
    {
        return mix($path, rtrim($this->asset(), '/'));
    }

    /**
     * Get the PinAdmin view template.
     * @param string $path
     * @return string
     */
    public function template(string $path): string
    {
        return $this->name() . '::' . $path;
    }

    /**
     * Get the view for PinAdmin.
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return Application|Factory|View
     */
    public function view(string $view, $data = [], $mergeData = [])
    {
        return view($this->template($view), $data, $mergeData);
    }

    /**
     * Get the available auth instance with the Admin's guard.
     * @return Guard|StatefulGuard
     */
    public function auth()
    {
        return Auth::guard($this->guard());
    }

    /**
     * Get the currently authenticated user.
     * @return Authenticatable|null
     */
    public function user(): ?Authenticatable
    {
        return $this->auth()->user();
    }
}