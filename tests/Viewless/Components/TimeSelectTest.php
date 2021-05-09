<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\TimeSelect;
use Orchestra\Testbench\TestCase;

class TimeSelectTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-time-select></el-time-select>', TimeSelect::make());
    }
}
