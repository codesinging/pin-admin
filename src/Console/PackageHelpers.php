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

            ksort($packages[$key]);

            file_put_contents(
                base_path('package.json'),
                json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
            );
        }
    }

    /**
     * Add packages to the 'package.json'.
     * @param array $packages
     * @param bool $dev
     */
    protected function addNodePackages(array $packages, bool $dev = true): void
    {
        $this->updateNodePackages(function ($originPackages) use ($packages){
            return $packages + $originPackages;
        }, $dev);
    }
}