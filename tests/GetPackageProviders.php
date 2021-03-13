<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests;

use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;

trait GetPackageProviders
{
    protected function getPackageProviders($app): array
    {
        return [AdminServiceProvider::class];
    }
}