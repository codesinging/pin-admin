<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Tooltip;
use Orchestra\Testbench\TestCase;

class TooltipTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-tooltip></el-tooltip>', Tooltip::make());
        self::assertEquals("<el-tooltip content='message'></el-tooltip>", Tooltip::make('message')->build());
    }
}
