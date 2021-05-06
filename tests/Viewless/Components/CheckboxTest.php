<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Checkbox;
use Orchestra\Testbench\TestCase;

class CheckboxTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-checkbox></el-checkbox>', Checkbox::make());
    }
}
