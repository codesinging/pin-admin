<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Rate;
use Orchestra\Testbench\TestCase;

class RateTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-rate></el-rate>", Rate::make());
    }
}
