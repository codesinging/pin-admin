<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Support;

use CodeSinging\PinAdmin\Foundation\Admin;
use Orchestra\Testbench\TestCase;

class HelpersTest extends TestCase
{
    public function testAdmin()
    {
        self::assertInstanceOf(Admin::class, admin());
    }
}
