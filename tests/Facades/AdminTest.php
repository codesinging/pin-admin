<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Facades;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Foundation\Admin as AdminClass;
use Orchestra\Testbench\TestCase;

class AdminTest extends TestCase
{
    public function testFacadeMethods()
    {
        self::assertEquals(AdminClass::NAME, Admin::name());
        self::assertEquals(AdminClass::VERSION, Admin::version());
    }
}
