<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

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
}