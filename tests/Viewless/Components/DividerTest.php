<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Divider;
use Orchestra\Testbench\TestCase;

class DividerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-divider></el-divider>', Divider::make());
    }
}
