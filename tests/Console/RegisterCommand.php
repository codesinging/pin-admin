<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use Illuminate\Console\Application;

trait RegisterCommand
{
    protected function registerCommand(string $command)
    {
        Application::starting(function (Application $artisan) use ($command){
            $artisan->add(app($command));
        });
    }
}