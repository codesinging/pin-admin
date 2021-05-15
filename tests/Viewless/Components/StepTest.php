<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Step;
use Orchestra\Testbench\TestCase;

class StepTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-step></el-step>", Step::make());
    }
}
