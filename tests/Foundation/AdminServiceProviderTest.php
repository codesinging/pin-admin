<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;
use CodeSinging\PinAdmin\Tests\GetPackageProviders;
use Orchestra\Testbench\TestCase;

class AdminServiceProviderTest extends TestCase
{
    use GetPackageProviders;

    public function testRegisterBinding()
    {
        self::assertInstanceOf(Admin::class, app(Admin::NAME));
    }

    public function testSingleton()
    {
        self::assertSame(app(Admin::NAME), app(Admin::NAME));
    }
}
