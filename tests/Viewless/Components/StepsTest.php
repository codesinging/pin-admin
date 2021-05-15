<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Steps;
use Orchestra\Testbench\TestCase;

class StepsTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-steps></el-steps>", Steps::make());
    }

    public function testAddStep()
    {
        self::assertEquals("<el-steps><el-step></el-step></el-steps>", Steps::make()->addStep());
    }
}
