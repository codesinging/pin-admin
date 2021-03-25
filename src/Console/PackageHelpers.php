<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console;

trait PackageHelpers
{
    /**
     * Update the 'package.json' file.
     * @param callable $callback
     * @param bool $dev
     */
    protected function updateNodePackages(callable $callback, bool $dev = true): void
    {
        if (file_exists(base_path('package.json'))){
            $key = $dev ? 'devDependencies': 'dependencies';

            $packages = json_decode(file_get_contents(base_path('package.json')), true);

            $packages[$key] = $callback(
                array_key_exists($key, $packages) ? $packages[$key]:[], $key
            );
        }
    }
}