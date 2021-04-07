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
     *
     * @param callable $callback
     * @param bool $dev
     */
    protected function updateNodePackages(callable $callback, bool $dev = true): void
    {
        $file = base_path('package.json');
        if (file_exists($file)) {
            $key = $dev ? 'devDependencies' : 'dependencies';

            $packages = json_decode(file_get_contents($file), true);

            $packages[$key] = $callback(
                array_key_exists($key, $packages) ? $packages[$key] : [], $key
            );

            ksort($packages[$key]);

            if(file_put_contents(
                $file,
                json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
            )){
                $this->info("Updated $key in file [{$file}]");
            } else {
                $this->warn("Updated node package error [{$file}]");
            }
        }
    }

    /**
     * Add packages to the 'package.json'.
     *
     * @param array $packages
     * @param bool $dev
     */
    protected function addNodePackages(array $packages, bool $dev = true): void
    {
        $this->updateNodePackages(function ($originPackages) use ($packages) {
            return $packages + $originPackages;
        }, $dev);
    }
}